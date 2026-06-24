# ITQAAN — Information Technology

موقع تعريفي ثنائي اللغة (عربي/إنجليزي) لشركة **إتقان لتقنية المعلومات**، مبني على Laravel 12 و Tailwind CSS v4 مع دعم كامل لـ RTL/LTR.

A bilingual (Arabic/English) corporate website for **ITQAAN Information Technology**, built with Laravel 12 and Tailwind CSS v4 with full RTL/LTR support.

---

## ✨ المميزات / Features

- 🌍 ثنائي اللغة (العربية افتراضياً) مع تبديل فوري للغة — `/ar` و `/en`
- ↔️ دعم كامل لـ RTL و LTR
- 🎨 هوية بصرية بألوان العلامة `#226b9f` و `#27abe3`
- 🅰️ خطوط عربية عصرية (IBM Plex Sans Arabic + Tajawal)
- 📱 تصميم متجاوب بالكامل (جوال / تابلت / ديسكتوب)
- ⚡ أنيميشن سلس (scroll-reveal، عدّادات، حركات دخول)
- 🧩 مكوّنات Blade قابلة لإعادة الاستخدام
- 🔍 تحسين SEO أساسي (meta, Open Graph, hreflang, JSON-LD)
- ✉️ نموذج تواصل + نموذج طلب مشروع متعدد الخطوات يرسل بريداً للشركة

## 📄 الصفحات / Pages

| المسار | الوصف |
| --- | --- |
| `/{locale}` | الصفحة الرئيسية (Hero, نبذة, خدمات, آلية العمل, أعمال, CTA) |
| `/{locale}/services` | الخدمات بالتفصيل |
| `/{locale}/portfolio` | معرض الأعمال |
| `/{locale}/portfolio/{slug}` | تفاصيل المشروع الكاملة |
| `/{locale}/contact` | نموذج التواصل + معلومات + خريطة |
| `/{locale}/request` | نموذج طلب مشروع متعدد الخطوات |

`{locale}` = `ar` (افتراضي) أو `en`.

---

## 🛠️ المتطلبات / Requirements

- PHP **8.2+**
- Composer 2.x
- Node.js 18+ و npm
- MySQL / MariaDB (قاعدة باسم `itqaan`)

## 🚀 التشغيل محلياً / Local development

```bash
composer install
npm install

# الإعداد (المفتاح موجود في .env بالفعل للتطوير المحلي)
cp .env.example .env   # عند الحاجة
php artisan key:generate

# قاعدة البيانات (أنشئ قاعدة MySQL باسم itqaan أولاً)
php artisan migrate
php artisan db:seed --class=AdminUserSeeder   # ينشئ حساب الأدمن

# بناء الأصول
npm run build          # أو: npm run dev (وضع المراقبة)

# تشغيل الخادم
php artisan serve
```

ثم افتح لوحة التحكم على <http://localhost:8000/admin>.

ثم افتح: <http://localhost:8000> (يحوّل تلقائياً إلى `/ar`).

---

## ✏️ تعديل المحتوى / Editing content

- **الخدمات، المشاريع، الإحصائيات، آلية العمل، خيارات نموذج الطلب، ومعلومات التواصل**
  كلها في ملف واحد: [`config/site.php`](config/site.php).
  كل قيمة قابلة للترجمة على شكل `['ar' => '...', 'en' => '...']`.
- **نصوص الواجهة** (الأزرار، العناوين، التسميات): في
  [`lang/ar/site.php`](lang/ar/site.php) و [`lang/en/site.php`](lang/en/site.php).
- **صور المشاريع**: ضعها في `public/images/projects/` وحدّث المسار في `config/site.php`.
- **الشعار**: استبدل `public/images/logo-mark.svg` و `favicon.svg` و `og-image.svg`
  بالأصول الرسمية إن رغبت (الشعار الحالي مبني كـ SVG داخلي عبر مكوّن `<x-logo>`).

## ✉️ إعداد البريد / Email setup

النموذجان (التواصل + طلب المشروع) يرسلان بريداً إلى العنوان المحدد في `MAIL_TO_ADDRESS`.
لتفعيل الإرسال الفعلي، عبّئ إعدادات SMTP في `.env`:

```dotenv
MAIL_MAILER=smtp
MAIL_HOST=smtp.your-provider.com
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_SCHEME=tls
MAIL_FROM_ADDRESS="noreply@itqaanit.com"
MAIL_TO_ADDRESS="info@itqaanit.com"
```

> أثناء التطوير `MAIL_MAILER=log` — تُكتب الرسائل في `storage/logs/laravel.log` بدلاً من إرسالها.
> فشل الإرسال لا يكسر تجربة المستخدم (يُسجَّل الخطأ فقط).

---

## 🔐 لوحة التحكم / Admin panel

لوحة التحكم مبنية على **Filament** وتتوفر على المسار **`/admin`**.

**إنشاء حساب الأدمن** (محلياً): القيم تؤخذ من `.env` (`ADMIN_EMAIL`, `ADMIN_PASSWORD`):

```bash
php artisan db:seed --class=AdminUserSeeder
# أو إنشاء حساب يدوياً:
php artisan make:filament-user
```

**ما تتيحه لوحة التحكم:**
- 📊 لوحة معلومات بإحصائيات (طلبات جديدة، إجمالي الطلبات، رسائل غير مقروءة)
- 🚀 **طلبات المشاريع**: عرض كامل لكل طلب، تغيير الحالة، ملاحظات داخلية، زر رد عبر واتساب، فلاتر
- ✉️ **رسائل التواصل**: عرض الرسائل، تمييزها كمقروءة تلقائياً، زر رد عبر واتساب
- ⚙️ **الإعدادات والتكاملات**: ربط تيليجرام (توكن + Chat ID) ورقم واتساب وبريد الإشعارات

### التكاملات / Integrations

| التكامل | الآلية |
| --- | --- |
| **تيليجرام** | إشعار فوري عبر Bot API عند كل طلب/رسالة جديدة. فعّله من صفحة الإعدادات وأدخل التوكن (من `@BotFather`) و Chat ID (من `@userinfobot`). جرّبه بزر «إرسال رسالة تجريبية». |
| **واتساب** | روابط `wa.me` — زر عائم في الموقع للتواصل، وأزرار رد سريعة بجانب كل طلب/رسالة في لوحة التحكم. يضبط الرقم من صفحة الإعدادات. |

> إعدادات التكاملات تُخزَّن في قاعدة البيانات (جدول `settings`) وتُدار من اللوحة — لا حاجة لتعديل `.env`.

---

## ☁️ النشر على Laravel Forge / Deploying to Laravel Forge

1. اربط المستودع من GitHub بموقعك على Forge (`itqaanit.com`).
2. Deploy script المقترح:

```bash
cd $FORGE_SITE_PATH
git pull origin $FORGE_SITE_BRANCH

composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

npm ci
npm run build

php artisan migrate --force
php artisan db:seed --class=AdminUserSeeder --force   # أول مرة فقط
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

3. في بيئة الإنتاج اضبط `.env`:
   - `APP_ENV=production` و `APP_DEBUG=false`
   - `APP_URL=https://itqaanit.com`
   - بيانات قاعدة بيانات MySQL (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)
   - `ADMIN_EMAIL` و `ADMIN_PASSWORD` قبل أول تشغيل للـ seeder
   - إعدادات SMTP أعلاه
4. فعّل شهادة SSL من Forge (Let's Encrypt).
5. بعد النشر، ادخل `/admin` واضبط التكاملات (تيليجرام/واتساب) من صفحة الإعدادات.

> قاعدة البيانات MySQL مطلوبة (تخزّن الطلبات والرسائل وإعدادات التكاملات).
> الجلسات/الكاش على `file` والطابور `sync`.

## 🧱 البنية / Project structure

```
app/
  Http/Controllers/   PageController, ContactController, ProjectRequestController
  Http/Middleware/    SetLocale
  Http/Requests/      ContactRequest, ProjectRequestRequest
  Mail/               ContactMail, ProjectRequestMail
  Support/Site.php    مساعد لقراءة المحتوى ثنائي اللغة
config/site.php       كل محتوى الموقع
lang/{ar,en}/site.php نصوص الواجهة
resources/
  css/app.css         إعداد Tailwind v4 (الألوان، الخطوط، الأنيميشن)
  js/app.js           scroll-reveal، القائمة، العدّادات، نموذج الخطوات
  views/
    components/       layouts/app, navbar, footer, logo, icon, cards, cta, ...
    pages/            home, services, portfolio, project, contact, request
    emails/           contact, project-request
routes/web.php        مسارات مجمّعة تحت {locale}
```

---

صُنع بإتقان · Made with ITQAAN
