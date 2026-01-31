# دليل الأيقونات - Treetor Icons Guide

## الأيقونات الاجتماعية (Social Media Icons)
تستخدم هذه الأيقونات Font Awesome 6 Brands

| الأيقونة | الكود | الرمز |
|---------|------|-------|
| Facebook | `<i class="icon-facebook"></i>` | \f39e |
| Twitter | `<i class="icon-twitter"></i>` | \f099 |
| Instagram | `<i class="icon-insta"></i>` | \f16d |
| LinkedIn | `<i class="icon-in"></i>` | \f0e1 |
| Google | `<i class="icon-google"></i>` | \f1a0 |

## الأيقونات العامة (General Icons)
تستخدم هذه الأيقونات Font Awesome 6 Free (Solid)

| الأيقونة | الكود | الرمز |
|---------|------|-------|
| البحث (Search) | `<i class="icon-search"></i>` | \f002 |
| الموقع (Location) | `<i class="icon-map-pin"></i>` | \f3c5 |
| الهاتف (Phone) | `<i class="icon-phone"></i>` | \f095 |
| البريد (Email) | `<i class="icon-mail"></i>` | \f0e0 |
| السلة (Cart) | `<i class="icon-cart"></i>` | \f07a |
| القلب (Heart) | `<i class="icon-heart"></i>` | \f004 |
| النجمة (Star) | `<i class="icon-star"></i>` | \f005 |
| المستخدم (User) | `<i class="icon-user"></i>` | \f007 |
| السهم (Arrow) | `<i class="icon-arrow"></i>` | \f107 |
| السهم الأيمن (Arrow Right) | `<i class="icon-arrow-md"></i>` | \f061 |
| التعليق (Comment) | `<i class="icon-comment"></i>` | \f075 |
| التاريخ (Date) | `<i class="icon-date"></i>` | \f073 |
| العين (Eye) | `<i class="icon-eye"></i>` | \f06e |
| الإغلاق (Close) | `<i class="icon-close"></i>` | \f00d |

## ملاحظات هامة

### للأيقونات الاجتماعية
يجب استخدام `font-family: "Font Awesome 6 Brands"` مع `font-weight: 400`

```css
.icon-facebook:before,
.icon-twitter:before,
.icon-insta:before,
.icon-in:before,
.icon-google:before {
    font-family: "Font Awesome 6 Brands" !important;
    font-weight: 400;
}
```

### للأيقونات العامة
تستخدم `font-family: "Font Awesome 6 Free"` مع `font-weight: 900`

```css
[class^="icon-"],
[class*=" icon-"] {
    font-family: "Font Awesome 6 Free" !important;
    font-weight: 900;
}
```

## الملفات المتضمنة

1. **style.css** - يحتوي على جميع تعريفات الأيقونات
2. **icon-fix.css** - يحتوي على إصلاحات خاصة للأيقونات الاجتماعية
3. **Font Awesome CDN** - `https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css`

## الاستخدام في Blade Templates

```html
<!-- أيقونات التواصل الاجتماعي -->
<div class="footer-top__social">
    <a href="#"><i class="icon-facebook"></i></a>
    <a href="#"><i class="icon-twitter"></i></a>
    <a href="#"><i class="icon-insta"></i></a>
    <a href="#"><i class="icon-in"></i></a>
</div>

<!-- أيقونات الإنستقرام -->
<div class="insta-photos">
    <a href="#" class="insta-photo">
        <img src="..." alt="">
        <div class="insta-photo__hover">
            <i class="icon-insta"></i>
        </div>
    </a>
</div>
```

## اختبار الأيقونات

يمكنك اختبار جميع الأيقونات عن طريق فتح:
`http://127.0.0.1:8002/icon-test.html`
