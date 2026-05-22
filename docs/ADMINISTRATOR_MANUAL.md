# Sahara Autolink — Administrator Manual

This guide is for staff who manage the **Sahara Autolink** public website and admin console. It covers day-to-day tasks: listings, customer requests, promotions, brands, and site settings.

---

## 1. What this system does

Sahara Autolink is a **vehicle marketplace website**. Visitors can:

- Browse and filter cars (English and Swahili)
- View vehicle details, save favourites, and contact the business
- Submit **import / order requests** with budget and preferences

Administrators use a separate **Admin Console** to keep inventory, content, and business details up to date. Changes in the console appear on the public site after you save them (published cars and published announcements only).

---

## 2. Accessing the admin console

| Item | Details |
|------|---------|
| **Login URL** | `https://your-domain.com/admin/login` |
| **Dashboard** | `https://your-domain.com/admin` (after login) |
| **Public website** | Open from the logo in the admin sidebar, or your live domain |

### Sign in

1. Open the login URL in a modern browser (Chrome, Edge, Firefox, or Safari).
2. Enter your **email** and **password** (minimum 8 characters).
3. After a successful login you are taken to **Overview** (dashboard).

### Sign out

Use **Logout** in the admin header. Always log out on shared computers.

### Login security

- After **5 failed attempts**, login is blocked briefly for your email and location.
- If you forget your password, contact your **technical administrator** to reset it in the system database. Passwords cannot be recovered from the admin screen.

### Who can log in?

Access is tied to **admin user accounts** stored in the application database (not a shared “master password” in the admin UI). Your IT team creates and maintains these accounts.

---

## 3. Admin console layout

The left menu has six sections:

| Menu | Purpose |
|------|---------|
| **Overview** | Summary counts, visitor trends, recent listings, latest order requests |
| **Inventory** | Add, edit, publish, and remove vehicles |
| **Orders** | Customer import / order requests from the website |
| **Offers & news** | Homepage announcement strip (offers, discounts, news) |
| **Brands** | Brand names and logos used on listings and filters |
| **Settings** | Business contact details, homepage shortcuts, colours |

On mobile, open the menu with the navigation control in the header.

---

## 4. Overview (dashboard)

The dashboard helps you monitor activity at a glance.

### Listing summary

- **Total listings** — all vehicles in the system (published and drafts)
- **Published** — visible on the public website
- **Drafts** — saved but not public
- **Featured** — highlighted on the homepage

Click **Total listings** to open Inventory.

### Visitors

Unique visitor counts are shown for today, the last 7 days, month, 6 months, and year. Percentage trends compare each period to the previous equivalent period (for example, this week vs last week).

### Order requests

- **Unread** count appears when new import requests need attention
- A short list of the latest requests is shown; open **Orders** for the full list

### Recent cars

Quick links to vehicles you added or updated recently.

> **Note:** “Monthly revenue” on the dashboard is a **sum of list prices** for cars **published in the current calendar month**. It is an indicative figure, not accounting revenue.

---

## 5. Inventory (vehicles)

Inventory is where you manage the car catalogue.

### List view

- Search by title
- Filter by **status** (all / published / draft), **featured**, and **price range**
- Sort columns and change how many rows appear per page (10, 25, 50, or 100)
- Actions: view, edit, or delete a listing

Summary chips at the top show total, active (published), and pending (draft) counts.

### Add a new vehicle

1. Go to **Inventory** → **Add** (or equivalent create action).
2. Complete the form (see fields below).
3. Ensure **Published** is checked when the listing should go live.
4. Submit to create the listing.

### Edit or remove

- **Edit** — change details, images, or publish state; save when finished.
- **Delete** — permanently removes the listing. Confirm only when you are certain; this cannot be undone from the admin UI.

### Important fields

| Field | Guidance |
|-------|----------|
| **Title** | Required. Clear name shown on cards and detail pages (e.g. “Toyota Land Cruiser 300”). |
| **Brand** | Choose from **Brands** (add brands first if the list is empty). |
| **Model, year, colour, body type, doors, seats** | Optional but recommended for search and buyer trust. |
| **Price (TZS)** | List price in Tanzanian shillings. |
| **Estimated landed cost (TZS)** | Optional; useful for import listings. |
| **Price policy** | Negotiable or not negotiable. |
| **Location** | e.g. Dar es Salaam |
| **Source country** | Japan, Germany, Thailand, UK, UAE, South Korea, Tanzania, etc. |
| **Condition** | Brand new, foreign used, or locally used |
| **Import status** | In Tanzania, on order, in transit, or ready for booking |
| **ETA** | Expected arrival date when applicable |
| **Mileage, engine, engine capacity (cc)** | Supports filters and sorting |
| **Description** | Full text for the detail page (up to 5,000 characters) |
| **Published** | Off = draft (hidden from public). On = live. |
| **Featured** | On = prioritised on the homepage |

**Slug** (edit only): URL-friendly ID. Leave blank to auto-generate from the title. Use lowercase letters, numbers, and hyphens only.

Public vehicle URLs use the form: `https://your-domain.com/cars/{id}`.

### Images

| Type | Rules |
|------|--------|
| **Hero image** | Main photo on listing cards |
| **Front / rear / side / interior** | Up to 12 images per group; multiple files allowed |
| **Gallery** | Up to 12 extra images |
| **Formats** | JPG, PNG, WebP, AVIF, HEIC/HEIF |
| **Size** | Maximum **5 MB** per file |

When editing, you can remove existing images with the checkboxes provided before uploading replacements.

### Best practices for listings

1. Add brands in **Brands** before creating many listings.
2. Upload a strong **hero image** first; add gallery shots for detail pages.
3. Keep **draft** until photos and price are final, then turn **Published** on.
4. Use **Featured** sparingly for your best stock.
5. Set **import status** and **ETA** accurately for cars not yet in country.

---

## 6. Orders (import / order requests)

Customers submit requests from the public **Order request** page. Those appear under **Orders** in the admin console.

### What you see

Each request typically includes:

- Name, email, phone
- Preferred brand and model
- Year range
- Source country preference
- Budget range (TZS)
- Customer notes (if provided)
- Date submitted
- **Pending** or **Done** status

### Workflow

1. Check **Overview** or **Orders** for pending items (the sidebar badge shows the pending count).
2. Use the filter tabs: **All**, **Pending**, or **Done**.
3. Contact the customer by email or phone.
4. Click **Mark done** when the request has been handled.
5. Click **Mark pending** if you need to reopen a request (for example, follow-up still required).

New requests arrive as **Pending** automatically.

> **Contact form messages** (from the **Contact** page) are stored in the system but **are not listed** in this admin section. Handle general contact messages through your support email or WhatsApp as configured in **Settings**.

---

## 7. Offers & news (announcements)

These items appear in the **“Offers & updates”** strip on the public homepage.

### Create or edit

1. Go to **Offers & news** → **New** (or edit an existing item).
2. Fill in:
   - **Title** (required)
   - **Short text** (optional one-line summary)
   - **Link** (optional) — full `https://…` URL or internal path such as `/en/cars`
   - **Open link in a new tab** (checkbox)
   - **Type** — Offer, Discount, or News / update
   - **Show from / Hide after** (optional schedule)
   - **Sort order** — lower numbers appear first
   - **Published on home** — must be on to display
3. Save.

### Delete

Removing an announcement deletes it permanently from the homepage strip.

---

## 8. Brands

Brands power the dropdown on vehicle forms and brand filters on the public site.

### Add a brand

1. Go to **Brands**.
2. Enter **name**, upload a **logo** (required for new brands; JPG/PNG/WebP/AVIF, max 5 MB).
3. Optionally set **featured** and **sort order**.
4. Save.

### Edit or delete

- Updating the **name** also updates the brand text on existing cars linked to that brand.
- **Delete** removes the brand record; ensure listings are reassigned if needed.

### Automatic sync

When you open **Brands**, the system may create brand entries from brand names already used on old listings so the picker is not empty.

---

## 9. Settings

**Settings** controls business and homepage content without editing code. Click **Save** at the bottom after changes.

### Core business details

- Marketplace name, support email, WhatsApp number (digits only, country code included, e.g. `255791666101`)
- Legal / registered entity name
- Public website URL
- Primary location label (e.g. “Dar es Salaam · Tanzania”)
- Public website URL, Instagram and Facebook URLs and labels (leave a social URL empty to hide that network)
- Google Maps embed and directions URLs, optional About / Why video embed URLs (all edited in Settings—not `.env`)
- Brand tagline, footer supporting text, hours summary

These values appear in the footer, contact page, WhatsApp links, and related public areas.

### Homepage modules

**Shortcut chips** — one per line:

```text
Label|URL
```

Example:

```text
From Japan|/en/cars?source_country=Japan
```

**Import flow steps** — one per line:

```text
Step title|Step description
```

Example:

```text
Quote|We share options, specs, and landed-cost estimates.
```

The form warns you if a line does not use the `left|right` format.

### Theme colours

Adjust **Primary**, **Secondary**, and **Primary container** colours. Use the live preview before saving. The reset control restores default Sahara branding colours.

Settings are saved to the server and apply site-wide after save.

---

## 10. Public website (what admins should know)

### Languages

The site supports **English (`/en/…`)** and **Swahili (`/sw/…`)** (or as configured by your host). Inventory detail pages use a shared URL: `/cars/{id}`.

### What visitors see

- Home, car listings, bento grid, why choose us, contact, order request, saved cars
- Only **published** vehicles appear in public search and listings
- **Featured** cars are emphasised on the home page
- Published **announcements** within their date range appear on the home strip

### What you do not manage in the console

Some content is fixed in language files or environment configuration (for example, map embed URLs, owner videos on “Why choose us”). Ask your technical administrator if those need to change.

---

## 11. Routine tasks (checklist)

| Frequency | Task |
|-----------|------|
| Daily | Review unread **Orders**; publish or update urgent stock |
| Weekly | Refresh **Featured** cars; check **Offers & news** dates |
| When stock changes | Add/edit **Inventory**; verify photos and prices |
| When contact details change | Update **Settings** (email, WhatsApp, hours, Instagram) |
| New marques | Add **Brands** before bulk listing imports |

---

## 12. Troubleshooting

| Problem | What to try |
|---------|-------------|
| Order stuck as pending | Open **Orders**, use **Mark done**; use **Mark pending** to reopen if needed |
| Cannot log in | Check email/password; wait if rate-limited; contact IT for password reset |
| Car not on website | Confirm **Published** is on; open the public URL in a private/incognito window |
| Images will not upload | Use supported formats; keep each file under 5 MB |
| Settings not visible on site | Save again; hard-refresh the public page (Ctrl+F5) |
| Brand missing in dropdown | Add it under **Brands**, then refresh the car form |
| Announcement not on home | Check **Published**, dates (**Show from** / **Hide after**), and sort order |

For server outages, database errors, or SSL/domain issues, contact your **hosting or development team**.

---

## 13. Roles and responsibilities

| Role | Typical duties |
|------|----------------|
| **Sales / inventory admin** | Listings, brands, order follow-up |
| **Marketing** | Offers & news, featured cars, homepage shortcuts |
| **Supervisor** | Settings, review dashboard metrics |
| **Technical administrator** | User accounts, backups, `.env` configuration, deployments |

---

## 14. Support

For account access, new admin users, or system errors, contact your organisation’s technical support.

For content questions (wording, pricing policy, legal name), follow your internal Sahara Autolink business guidelines.

---

*Document version: 1.0 — Sahara Autolink admin console*
