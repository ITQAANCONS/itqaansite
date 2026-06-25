<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'slug' => 'why-your-business-needs-a-modern-website',
                'title_ar' => 'لماذا يحتاج عملك إلى موقع إلكتروني عصري؟',
                'title_en' => 'Why Your Business Needs a Modern Website',
                'category_ar' => 'تطوير الويب', 'category_en' => 'Web Development',
                'excerpt_ar' => 'الموقع الإلكتروني لم يعد رفاهية، بل واجهتك الرقمية الأولى أمام عملائك. نستعرض لماذا يصنع الموقع العصري فرقاً حقيقياً.',
                'excerpt_en' => 'A website is no longer a luxury — it is your first digital storefront. Here is why a modern site makes a real difference.',
                'body_ar' => '<h2>الانطباع الأول يُصنع رقمياً</h2><p>اليوم، أول ما يفعله عميلك المحتمل هو البحث عنك على الإنترنت. الموقع العصري السريع والمتجاوب يبني الثقة من أول ثانية.</p><h3>ما الذي يميّز الموقع العصري؟</h3><ul><li>سرعة تحميل عالية وتجربة سلسة على الجوال.</li><li>تصميم نظيف يعكس احترافية علامتك.</li><li>تحسين لمحركات البحث ليجدك العملاء.</li></ul><p>في إتقان نبني مواقع تجمع بين الجمال والأداء لتحوّل الزوار إلى عملاء.</p>',
                'body_en' => '<h2>First impressions are digital</h2><p>Today, the first thing a potential client does is search for you online. A fast, responsive modern website builds trust from the first second.</p><h3>What sets a modern site apart?</h3><ul><li>High load speed and a smooth mobile experience.</li><li>Clean design that reflects your brand.</li><li>SEO so customers can find you.</li></ul><p>At ITQAAN we build sites that blend beauty and performance to turn visitors into customers.</p>',
                'author' => 'فريق إتقان', 'is_featured' => true,
            ],
            [
                'slug' => 'ai-in-saudi-businesses',
                'title_ar' => 'الذكاء الاصطناعي في الأعمال السعودية: من أين تبدأ؟',
                'title_en' => 'AI in Saudi Businesses: Where to Start',
                'category_ar' => 'الذكاء الاصطناعي', 'category_en' => 'AI',
                'excerpt_ar' => 'الذكاء الاصطناعي ليس حكراً على الشركات الكبرى. إليك خطوات عملية لإدخاله في عملك بذكاء.',
                'excerpt_en' => 'AI is not just for large enterprises. Here are practical steps to bring it into your business wisely.',
                'body_ar' => '<h2>ابدأ بمشكلة حقيقية</h2><p>أفضل مشاريع الذكاء الاصطناعي تبدأ بمشكلة واضحة: خدمة عملاء بطيئة، أو مهام متكررة تستهلك الوقت.</p><h3>تطبيقات عملية</h3><ul><li>روبوتات محادثة للرد الفوري على العملاء.</li><li>أتمتة المهام المتكررة.</li><li>تحليل البيانات لاتخاذ قرارات أفضل.</li></ul><p>نساعدك في إتقان على اختيار التطبيق الأنسب لحجم عملك وأهدافك.</p>',
                'body_en' => '<h2>Start with a real problem</h2><p>The best AI projects start with a clear problem: slow customer service, or repetitive time-consuming tasks.</p><h3>Practical applications</h3><ul><li>Chatbots for instant customer replies.</li><li>Automating repetitive tasks.</li><li>Data analysis for better decisions.</li></ul><p>At ITQAAN we help you choose the right application for your size and goals.</p>',
                'author' => 'فريق إتقان', 'is_featured' => false,
            ],
        ];

        foreach ($posts as $i => $p) {
            BlogPost::updateOrCreate(['slug' => $p['slug']], array_merge($p, [
                'status' => 'published',
                'published_at' => now()->subDays(($i + 1) * 3),
            ]));
        }
    }
}
