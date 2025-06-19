# 📢 Post Feed API

This Laravel-based project is a test implementation of a post feed system that:

- Ranks posts by **hotness**
- Excludes posts that the user has already viewed
- Excludes posts with more than **1000 views**
- Supports **Laravel-style pagination**
- Tracks user **views per post**

---

## 🚀 Features

- ✅ REST API
- 🔥 "Hotness" ranking logic
- 👤 User-specific filtering (already viewed posts)
- 📈 Global view tracking
- 🧪 Seeders with fake data (posts, views, users)

---

## 📦 Installation

```bash
git clone https://github.com/hovhannisyan-dev/post-feed.git
cd post-feed
composer install
cp .env.example .env
php artisan key:generate
````
```bash
php artisan migrate --seed

```
# GET /api/feed

| Parameter  | Type    | Required | Description                   |
| ---------- | ------- | -------- | ----------------------------- |
| `user_id`  | integer | ✅ Yes    | The ID of the requesting user |
| `page`     | integer | No       | Page number for pagination    |
| `per_page` | integer | No       | Posts per page (default: 15)  |


# POST /api/mark-viewed

- Payload:
{
"user_id": 1,
"post_id": 123
}

- Response:
{
"success": true
}


