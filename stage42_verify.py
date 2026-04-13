import re
import time
import random
import base64
import requests

BASE = "https://recipe-world-roman.vercel.app"


def get_csrf(html: str):
    m = re.search(r'name="_token"\s+value="([^"]+)"', html)
    return m.group(1) if m else None


def assert_true(cond, msg):
    if not cond:
        raise RuntimeError(msg)


def register_user(session, name_prefix):
    stamp = str(int(time.time())) + str(random.randint(1000, 9999))
    email = f"{name_prefix}_{stamp}@example.com"

    r = session.get(f"{BASE}/register", timeout=30)
    assert_true(r.status_code == 200, f"Register page failed: {r.status_code}")
    token = get_csrf(r.text)
    assert_true(token, "CSRF token missing on register page")

    payload = {
        "_token": token,
        "name": f"{name_prefix}_{stamp}",
        "email": email,
        "password": "Password123!",
        "password_confirmation": "Password123!",
    }
    r2 = session.post(f"{BASE}/register", data=payload, allow_redirects=True, timeout=30)
    assert_true(r2.status_code == 200, f"Register submit unexpected status: {r2.status_code}")
    assert_true("logout" in r2.text.lower() or "/home" in r2.url or "/dashboard" in r2.url,
                "Registration did not appear to authenticate user")
    return email


def login_user(session, email):
    r = session.get(f"{BASE}/login", timeout=30)
    assert_true(r.status_code == 200, f"Login page failed: {r.status_code}")
    token = get_csrf(r.text)
    assert_true(token, "CSRF token missing on login page")
    payload = {
        "_token": token,
        "email": email,
        "password": "Password123!",
    }
    r2 = session.post(f"{BASE}/login", data=payload, allow_redirects=True, timeout=30)
    assert_true(r2.status_code == 200, f"Login submit unexpected status: {r2.status_code}")
    assert_true("logout" in r2.text.lower() or "/home" in r2.url or "/dashboard" in r2.url,
                "Login did not appear to authenticate user")


def create_recipe(session):
    r = session.get(f"{BASE}/recipes/create", timeout=30)
    assert_true(r.status_code == 200, f"Create page failed: {r.status_code}")
    token = get_csrf(r.text)
    assert_true(token, "CSRF token missing on create page")

    cats = re.findall(r'<option value="(\d+)"', r.text)
    category_id = cats[0] if cats else ""
    title = f"Stage42 Test Recipe {int(time.time())}"

    payload = {
        "_token": token,
        "title": title,
        "description": "Stage 42 automated verification recipe",
        "instructions": "1. Mix. 2. Cook. 3. Serve.",
        "prep_time": "10",
        "cook_time": "20",
        "servings": "2",
        "difficulty": "medium",
        "category_id": category_id,
        "ingredients[0][name]": "Flour",
        "ingredients[0][quantity]": "2 cups",
    }

    # 1x1 transparent PNG
    image_bytes = base64.b64decode(
        "iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO5nVxkAAAAASUVORK5CYII="
    )
    files = {
        "image_path": ("stage42.png", image_bytes, "image/png")
    }

    r2 = session.post(f"{BASE}/recipes", data=payload, files=files, allow_redirects=False, timeout=30)
    assert_true(r2.status_code in (302, 303), f"Create recipe expected redirect, got {r2.status_code}")
    loc = r2.headers.get("Location", "")
    m = re.search(r"/recipes/(\d+)", loc)
    assert_true(m, f"Could not parse recipe id from redirect location: {loc}")
    rid = m.group(1)

    show = session.get(f"{BASE}/recipes/{rid}", timeout=30)
    assert_true(show.status_code == 200, f"Show recipe failed: {show.status_code}")
    assert_true(title in show.text, "Created recipe title not found on show page")

    return rid, title, category_id


def update_recipe(session, rid, category_id):
    edit = session.get(f"{BASE}/recipes/{rid}/edit", timeout=30)
    assert_true(edit.status_code == 200, f"Edit page failed for owner: {edit.status_code}")
    token = get_csrf(edit.text)
    assert_true(token, "CSRF token missing on edit page")

    new_title = f"Stage42 Updated Recipe {int(time.time())}"
    payload = {
        "_token": token,
        "_method": "PUT",
        "title": new_title,
        "description": "Updated description",
        "instructions": "Updated instructions",
        "prep_time": "12",
        "cook_time": "22",
        "servings": "3",
        "difficulty": "hard",
        "category_id": category_id,
        "ingredients[0][name]": "Sugar",
        "ingredients[0][quantity]": "1 cup",
    }
    r = session.post(f"{BASE}/recipes/{rid}", data=payload, allow_redirects=False, timeout=30)
    assert_true(r.status_code in (302, 303), f"Update expected redirect, got {r.status_code}")

    show = session.get(f"{BASE}/recipes/{rid}", timeout=30)
    assert_true(show.status_code == 200, f"Show after update failed: {show.status_code}")
    assert_true(new_title in show.text, "Updated title not found")
    return new_title


def verify_search_filter(session, title, category_id):
    s = session.get(f"{BASE}/recipes?search={requests.utils.quote(title)}", timeout=30)
    assert_true(s.status_code == 200, f"Search request failed: {s.status_code}")
    assert_true(title in s.text, "Search results did not include updated recipe")

    d = session.get(f"{BASE}/recipes?difficulty=hard", timeout=30)
    assert_true(d.status_code == 200, f"Difficulty filter failed: {d.status_code}")
    assert_true(title in d.text, "Difficulty filter did not include updated recipe")

    if category_id:
        c = session.get(f"{BASE}/recipes?category={category_id}", timeout=30)
        assert_true(c.status_code == 200, f"Category filter failed: {c.status_code}")
        assert_true(title in c.text, "Category filter did not include updated recipe")


def verify_authorization(user2_session, rid):
    e = user2_session.get(f"{BASE}/recipes/{rid}/edit", allow_redirects=False, timeout=30)
    assert_true(e.status_code in (302, 403), f"Expected 302/403 for unauthorized edit, got {e.status_code}")

    page = user2_session.get(f"{BASE}/recipes/{rid}", timeout=30)
    token = get_csrf(page.text)
    assert_true(token, "CSRF token missing on show page for auth test")
    d = user2_session.post(f"{BASE}/recipes/{rid}", data={"_token": token, "_method": "DELETE"}, allow_redirects=False, timeout=30)
    assert_true(d.status_code in (302, 403), f"Expected 302/403 for unauthorized delete, got {d.status_code}")


def delete_recipe(owner_session, rid):
    page = owner_session.get(f"{BASE}/recipes/{rid}", timeout=30)
    token = get_csrf(page.text)
    assert_true(token, "CSRF token missing before owner delete")
    d = owner_session.post(f"{BASE}/recipes/{rid}", data={"_token": token, "_method": "DELETE"}, allow_redirects=False, timeout=30)
    assert_true(d.status_code in (302, 303), f"Owner delete expected redirect, got {d.status_code}")

    check = owner_session.get(f"{BASE}/recipes/{rid}", allow_redirects=False, timeout=30)
    assert_true(check.status_code in (404, 302), f"Deleted recipe still appears accessible: {check.status_code}")


if __name__ == "__main__":
    s1 = requests.Session()
    s2 = requests.Session()

    print("[1] Register user 1")
    email1 = register_user(s1, "stage42user1")
    print("  user1:", email1)

    print("[2] Register user 2")
    email2 = register_user(s2, "stage42user2")
    print("  user2:", email2)

    print("[3] Create recipe (user1)")
    rid, title, category_id = create_recipe(s1)
    print("  recipe id:", rid)

    print("[4] Edit recipe (user1)")
    updated_title = update_recipe(s1, rid, category_id)

    print("[5] Verify search/filter")
    verify_search_filter(s1, updated_title, category_id)

    print("[6] Verify authorization (user2 cannot edit/delete user1 recipe)")
    verify_authorization(s2, rid)

    print("[7] Delete recipe (user1)")
    delete_recipe(s1, rid)

    print("RESULT: PASS")
