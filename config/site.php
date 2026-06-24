<?php

/*
|--------------------------------------------------------------------------
| ITQAAN — Central site content
|--------------------------------------------------------------------------
| All bilingual structural content lives here so it can be edited in one
| place. UI strings (labels, buttons) live in lang/{ar,en}/site.php.
| Each localizable value is an array: ['ar' => '...', 'en' => '...'].
*/

return [

    'company' => [
        'name'  => ['ar' => 'إتقان لتقنية المعلومات', 'en' => 'ITQAAN Information Technology'],
        'short' => ['ar' => 'إتقان', 'en' => 'ITQAAN'],
        'tagline' => [
            'ar' => 'نصنع حلولاً تقنية تُلهم وتنمو مع أعمالك',
            'en' => 'We craft technology that inspires and grows your business',
        ],
    ],

    'contact' => [
        'email'    => env('MAIL_TO_ADDRESS', 'info@itqaanit.com'),
        'phone'    => '+966 50 000 0000',
        'whatsapp' => '966500000000',
        'address'  => ['ar' => 'الرياض، المملكة العربية السعودية', 'en' => 'Riyadh, Saudi Arabia'],
        // Google Maps embed query (place name or coordinates)
        'map_query' => 'Riyadh,Saudi Arabia',
    ],

    'social' => [
        'twitter'   => 'https://x.com/',
        'linkedin'  => 'https://www.linkedin.com/',
        'instagram' => 'https://www.instagram.com/',
        'github'    => 'https://github.com/',
    ],

    'stats' => [
        ['value' => '+120', 'label' => ['ar' => 'مشروع منجز', 'en' => 'Projects delivered']],
        ['value' => '+80',  'label' => ['ar' => 'عميل سعيد', 'en' => 'Happy clients']],
        ['value' => '+10',  'label' => ['ar' => 'سنوات خبرة', 'en' => 'Years of experience']],
        ['value' => '24/7', 'label' => ['ar' => 'دعم فني', 'en' => 'Technical support']],
    ],

    'services' => [
        [
            'slug' => 'web-development',
            'icon' => 'code',
            'title' => ['ar' => 'تطوير المواقع والأنظمة', 'en' => 'Web & Systems Development'],
            'excerpt' => [
                'ar' => 'مواقع وأنظمة ويب مخصصة عالية الأداء مبنية على أحدث التقنيات مثل Laravel.',
                'en' => 'High-performance custom websites and web systems built on modern stacks like Laravel.',
            ],
            'features' => [
                'ar' => ['أنظمة إدارة محتوى مخصصة', 'لوحات تحكم وتقارير', 'تكامل مع واجهات API', 'أداء وأمان عاليان'],
                'en' => ['Custom CMS solutions', 'Dashboards & reporting', 'API integrations', 'High performance & security'],
            ],
        ],
        [
            'slug' => 'mobile-apps',
            'icon' => 'device',
            'title' => ['ar' => 'تطبيقات الجوال', 'en' => 'Mobile Applications'],
            'excerpt' => [
                'ar' => 'تطبيقات iOS و Android سلسة وعصرية تمنح مستخدميك تجربة استثنائية.',
                'en' => 'Smooth, modern iOS and Android apps that give your users an exceptional experience.',
            ],
            'features' => [
                'ar' => ['تطبيقات أصلية وهجينة', 'تصميم تجربة مستخدم متميز', 'إشعارات فورية', 'نشر على المتاجر'],
                'en' => ['Native & hybrid apps', 'Outstanding UX design', 'Push notifications', 'Store publishing'],
            ],
        ],
        [
            'slug' => 'ecommerce',
            'icon' => 'cart',
            'title' => ['ar' => 'المتاجر الإلكترونية', 'en' => 'E-Commerce'],
            'excerpt' => [
                'ar' => 'متاجر إلكترونية متكاملة مع بوابات دفع آمنة وإدارة مخزون ذكية.',
                'en' => 'Complete online stores with secure payment gateways and smart inventory management.',
            ],
            'features' => [
                'ar' => ['بوابات دفع متعددة', 'إدارة المنتجات والمخزون', 'تجربة شراء سريعة', 'تقارير المبيعات'],
                'en' => ['Multiple payment gateways', 'Product & inventory management', 'Fast checkout', 'Sales analytics'],
            ],
        ],
        [
            'slug' => 'ui-ux',
            'icon' => 'sparkles',
            'title' => ['ar' => 'تصميم تجربة المستخدم UI/UX', 'en' => 'UI/UX Design'],
            'excerpt' => [
                'ar' => 'واجهات جميلة وسهلة الاستخدام مبنية على فهم عميق لسلوك المستخدم.',
                'en' => 'Beautiful, intuitive interfaces grounded in deep understanding of user behavior.',
            ],
            'features' => [
                'ar' => ['أبحاث المستخدم', 'النماذج الأولية التفاعلية', 'أنظمة تصميم متكاملة', 'اختبارات قابلية الاستخدام'],
                'en' => ['User research', 'Interactive prototyping', 'Design systems', 'Usability testing'],
            ],
        ],
        [
            'slug' => 'graphic-design',
            'icon' => 'brush',
            'title' => ['ar' => 'التصميم الجرافيكي والهوية البصرية', 'en' => 'Graphic Design & Branding'],
            'excerpt' => [
                'ar' => 'هويات بصرية وشعارات تعبّر عن علامتك التجارية وتتركبها في الأذهان.',
                'en' => 'Visual identities and logos that express your brand and make it memorable.',
            ],
            'features' => [
                'ar' => ['تصميم الشعارات', 'الهوية البصرية الكاملة', 'المطبوعات والإعلانات', 'محتوى السوشيال ميديا'],
                'en' => ['Logo design', 'Full visual identity', 'Print & advertising', 'Social media content'],
            ],
        ],
        [
            'slug' => 'digital-marketing-seo',
            'icon' => 'megaphone',
            'title' => ['ar' => 'التسويق الرقمي و SEO', 'en' => 'Digital Marketing & SEO'],
            'excerpt' => [
                'ar' => 'استراتيجيات تسويق رقمي وتحسين لمحركات البحث ترفع ظهورك وتزيد عملاءك.',
                'en' => 'Digital marketing and SEO strategies that boost your visibility and grow your customers.',
            ],
            'features' => [
                'ar' => ['تحسين محركات البحث', 'إدارة الحملات الإعلانية', 'تحليل الأداء', 'تسويق المحتوى'],
                'en' => ['Search engine optimization', 'Ad campaign management', 'Performance analytics', 'Content marketing'],
            ],
        ],
        [
            'slug' => 'ai-solutions',
            'icon' => 'chip',
            'title' => ['ar' => 'حلول الذكاء الاصطناعي', 'en' => 'AI Solutions'],
            'excerpt' => [
                'ar' => 'دمج الذكاء الاصطناعي في أعمالك عبر روبوتات محادثة وأتمتة ذكية وتحليلات.',
                'en' => 'Bring AI into your business with chatbots, smart automation, and analytics.',
            ],
            'features' => [
                'ar' => ['روبوتات محادثة ذكية', 'أتمتة العمليات', 'تحليل البيانات', 'نماذج لغوية مخصصة'],
                'en' => ['Smart chatbots', 'Process automation', 'Data analysis', 'Custom language models'],
            ],
        ],
        [
            'slug' => 'hosting-support',
            'icon' => 'server',
            'title' => ['ar' => 'الاستضافة والدعم الفني', 'en' => 'Hosting & Technical Support'],
            'excerpt' => [
                'ar' => 'استضافة موثوقة وصيانة ودعم فني مستمر يضمن استمرارية أعمالك دون توقف.',
                'en' => 'Reliable hosting, maintenance, and ongoing support that keeps your business running.',
            ],
            'features' => [
                'ar' => ['استضافة عالية الأداء', 'نسخ احتياطي تلقائي', 'مراقبة على مدار الساعة', 'دعم فني سريع'],
                'en' => ['High-performance hosting', 'Automated backups', '24/7 monitoring', 'Fast technical support'],
            ],
        ],
        [
            'slug' => 'cloud-devops',
            'icon' => 'cloud',
            'title' => ['ar' => 'الحلول السحابية و DevOps', 'en' => 'Cloud & DevOps'],
            'excerpt' => [
                'ar' => 'بنية تحتية سحابية قابلة للتوسع وأتمتة النشر لتسريع تطوير منتجاتك.',
                'en' => 'Scalable cloud infrastructure and deployment automation to speed up your delivery.',
            ],
            'features' => [
                'ar' => ['البنية السحابية', 'أنابيب CI/CD', 'الحاويات و Docker', 'التوسع التلقائي'],
                'en' => ['Cloud infrastructure', 'CI/CD pipelines', 'Containers & Docker', 'Auto-scaling'],
            ],
        ],
        [
            'slug' => 'it-consulting',
            'icon' => 'bulb',
            'title' => ['ar' => 'الاستشارات التقنية', 'en' => 'IT Consulting'],
            'excerpt' => [
                'ar' => 'استشارات وتخطيط تقني يساعدك على اتخاذ القرارات الصحيحة لمشاريعك.',
                'en' => 'Technical consulting and planning that helps you make the right decisions for your projects.',
            ],
            'features' => [
                'ar' => ['تحليل المتطلبات', 'اختيار التقنيات', 'خرائط الطريق التقنية', 'تحسين الأنظمة'],
                'en' => ['Requirements analysis', 'Technology selection', 'Technical roadmaps', 'System optimization'],
            ],
        ],
    ],

    'projects' => [
        [
            'slug' => 'art-creator',
            'title' => ['ar' => 'آرت كرييتور', 'en' => 'Art Creator'],
            'category' => ['ar' => 'منصة إبداعية', 'en' => 'Creative Platform'],
            'url' => 'https://artcreator.sa',
            'year' => '2024',
            'client' => ['ar' => 'آرت كرييتور', 'en' => 'Art Creator'],
            'image' => 'images/projects/art-creator.svg',
            'excerpt' => [
                'ar' => 'منصة إبداعية تجمع الفنانين والمصممين وتمكّنهم من عرض أعمالهم.',
                'en' => 'A creative platform connecting artists and designers to showcase their work.',
            ],
            'description' => [
                'ar' => 'صممنا وطوّرنا منصة آرت كرييتور لتكون وجهة رقمية متكاملة للمبدعين في السعودية، تتيح لهم إنشاء معارض رقمية، عرض أعمالهم الفنية، والتواصل مع العملاء. ركّزنا على تجربة استخدام سلسة وتصميم بصري يعكس الطابع الإبداعي للمنصة.',
                'en' => 'We designed and built Art Creator as a complete digital destination for creatives in Saudi Arabia — enabling digital galleries, portfolio showcases, and client connections. We focused on a seamless experience and a visual design that reflects the platform\'s creative spirit.',
            ],
            'services' => ['web-development', 'ui-ux', 'graphic-design'],
        ],
        [
            'slug' => 'masar-legal',
            'title' => ['ar' => 'مسار ليجال', 'en' => 'Masar Legal'],
            'category' => ['ar' => 'خدمات قانونية', 'en' => 'Legal Services'],
            'url' => 'https://masarlegal.com',
            'year' => '2024',
            'client' => ['ar' => 'مسار ليجال', 'en' => 'Masar Legal'],
            'image' => 'images/projects/masar-legal.svg',
            'excerpt' => [
                'ar' => 'منصة متكاملة لإدارة الخدمات القانونية والتواصل بين المحامين والعملاء.',
                'en' => 'An integrated platform for managing legal services and lawyer–client communication.',
            ],
            'description' => [
                'ar' => 'بنينا منصة مسار ليجال لرقمنة الخدمات القانونية، حيث تتيح للعملاء طلب الاستشارات، متابعة القضايا، وإدارة المستندات بشكل آمن. اعتمدنا بنية قوية وآمنة تحافظ على سرية البيانات القانونية الحساسة.',
                'en' => 'We built Masar Legal to digitize legal services, allowing clients to request consultations, track cases, and manage documents securely. We adopted a robust, secure architecture that protects sensitive legal data.',
            ],
            'services' => ['web-development', 'ui-ux', 'cloud-devops'],
        ],
        [
            'slug' => 'smart-retail',
            'title' => ['ar' => 'متجر سمارت ريتيل', 'en' => 'Smart Retail Store'],
            'category' => ['ar' => 'متجر إلكتروني', 'en' => 'E-Commerce'],
            'url' => '#',
            'year' => '2023',
            'client' => ['ar' => 'سمارت ريتيل', 'en' => 'Smart Retail'],
            'image' => 'images/projects/smart-retail.svg',
            'excerpt' => [
                'ar' => 'متجر إلكتروني متكامل مع بوابات دفع وإدارة مخزون متقدمة.',
                'en' => 'A full e-commerce store with payment gateways and advanced inventory management.',
            ],
            'description' => [
                'ar' => 'طوّرنا متجراً إلكترونياً متكاملاً يدعم آلاف المنتجات مع تجربة شراء سريعة، بوابات دفع متعددة، ولوحة تحكم متقدمة لإدارة الطلبات والمخزون والتقارير.',
                'en' => 'We developed a complete e-commerce store supporting thousands of products with a fast checkout, multiple payment gateways, and an advanced dashboard for orders, inventory, and reports.',
            ],
            'services' => ['ecommerce', 'web-development', 'ui-ux'],
        ],
        [
            'slug' => 'health-app',
            'title' => ['ar' => 'تطبيق صحتي', 'en' => 'Sehaty App'],
            'category' => ['ar' => 'تطبيق جوال', 'en' => 'Mobile App'],
            'url' => '#',
            'year' => '2023',
            'client' => ['ar' => 'صحتي', 'en' => 'Sehaty'],
            'image' => 'images/projects/health-app.svg',
            'excerpt' => [
                'ar' => 'تطبيق جوال للرعاية الصحية يربط المرضى بالأطباء ويدير المواعيد.',
                'en' => 'A healthcare mobile app connecting patients with doctors and managing appointments.',
            ],
            'description' => [
                'ar' => 'صممنا وطوّرنا تطبيقاً للرعاية الصحية يتيح حجز المواعيد، الاستشارات عن بُعد، ومتابعة الملف الصحي، مع تصميم بسيط يناسب جميع الفئات العمرية.',
                'en' => 'We designed and built a healthcare app enabling appointment booking, remote consultations, and health-record tracking, with a simple design suited to all ages.',
            ],
            'services' => ['mobile-apps', 'ui-ux', 'ai-solutions'],
        ],
        [
            'slug' => 'corporate-identity',
            'title' => ['ar' => 'هوية شركة نخبة', 'en' => 'Nukhba Brand Identity'],
            'category' => ['ar' => 'هوية بصرية', 'en' => 'Branding'],
            'url' => '#',
            'year' => '2023',
            'client' => ['ar' => 'نخبة', 'en' => 'Nukhba'],
            'image' => 'images/projects/corporate-identity.svg',
            'excerpt' => [
                'ar' => 'هوية بصرية كاملة لشركة ناشئة شملت الشعار ودليل العلامة التجارية.',
                'en' => 'A complete visual identity for a startup, including logo and brand guidelines.',
            ],
            'description' => [
                'ar' => 'أنشأنا هوية بصرية متكاملة شملت تصميم الشعار، نظام الألوان، الخطوط، والمطبوعات، مع دليل شامل للعلامة التجارية يضمن اتساق الظهور عبر جميع القنوات.',
                'en' => 'We created a complete visual identity covering logo design, color system, typography, and print materials, with a comprehensive brand guide ensuring consistency across all channels.',
            ],
            'services' => ['graphic-design', 'ui-ux'],
        ],
        [
            'slug' => 'cloud-dashboard',
            'title' => ['ar' => 'لوحة تحكم سحابية', 'en' => 'Cloud Operations Dashboard'],
            'category' => ['ar' => 'نظام ويب', 'en' => 'Web System'],
            'url' => '#',
            'year' => '2022',
            'client' => ['ar' => 'عميل مؤسسي', 'en' => 'Enterprise Client'],
            'image' => 'images/projects/cloud-dashboard.svg',
            'excerpt' => [
                'ar' => 'لوحة تحكم لإدارة العمليات السحابية ومراقبة الأداء في الوقت الحقيقي.',
                'en' => 'A dashboard for managing cloud operations and monitoring performance in real time.',
            ],
            'description' => [
                'ar' => 'بنينا لوحة تحكم مؤسسية لمراقبة البنية السحابية، عرض المقاييس في الوقت الحقيقي، وإدارة الموارد، مع تكامل DevOps كامل وأتمتة للنشر.',
                'en' => 'We built an enterprise dashboard to monitor cloud infrastructure, display real-time metrics, and manage resources, with full DevOps integration and deployment automation.',
            ],
            'services' => ['web-development', 'cloud-devops', 'ui-ux'],
        ],
    ],

    'process' => [
        ['icon' => 'chat', 'title' => ['ar' => 'الاستماع والتخطيط', 'en' => 'Discovery & Planning'], 'desc' => ['ar' => 'نفهم احتياجاتك وأهدافك ونضع خطة واضحة.', 'en' => 'We understand your needs and goals and set a clear plan.']],
        ['icon' => 'sparkles', 'title' => ['ar' => 'التصميم', 'en' => 'Design'], 'desc' => ['ar' => 'نصمم تجربة وواجهات تعكس هويتك.', 'en' => 'We design experiences and interfaces that reflect your identity.']],
        ['icon' => 'code', 'title' => ['ar' => 'التطوير', 'en' => 'Development'], 'desc' => ['ar' => 'نبني الحل بأحدث التقنيات وأعلى المعايير.', 'en' => 'We build the solution with modern tech and high standards.']],
        ['icon' => 'rocket', 'title' => ['ar' => 'الإطلاق والدعم', 'en' => 'Launch & Support'], 'desc' => ['ar' => 'نطلق مشروعك وندعمك باستمرار بعد الإطلاق.', 'en' => 'We launch your project and keep supporting you afterwards.']],
    ],

    // Options shown in the project request form
    'request_options' => [
        'project_types' => [
            'website'     => ['ar' => 'موقع إلكتروني', 'en' => 'Website'],
            'web_system'  => ['ar' => 'نظام / منصة ويب', 'en' => 'Web system / platform'],
            'mobile_app'  => ['ar' => 'تطبيق جوال', 'en' => 'Mobile app'],
            'ecommerce'   => ['ar' => 'متجر إلكتروني', 'en' => 'E-commerce store'],
            'branding'    => ['ar' => 'هوية بصرية / تصميم', 'en' => 'Branding / design'],
            'marketing'   => ['ar' => 'تسويق رقمي / SEO', 'en' => 'Digital marketing / SEO'],
            'other'       => ['ar' => 'أخرى', 'en' => 'Other'],
        ],
        'budgets' => [
            'lt_10k'    => ['ar' => 'أقل من ١٠٬٠٠٠ ر.س', 'en' => 'Less than 10,000 SAR'],
            '10k_30k'   => ['ar' => '١٠٬٠٠٠ – ٣٠٬٠٠٠ ر.س', 'en' => '10,000 – 30,000 SAR'],
            '30k_70k'   => ['ar' => '٣٠٬٠٠٠ – ٧٠٬٠٠٠ ر.س', 'en' => '30,000 – 70,000 SAR'],
            'gt_70k'    => ['ar' => 'أكثر من ٧٠٬٠٠٠ ر.س', 'en' => 'More than 70,000 SAR'],
            'not_sure'  => ['ar' => 'غير محدد بعد', 'en' => 'Not decided yet'],
        ],
        'timelines' => [
            'urgent'    => ['ar' => 'عاجل (أقل من شهر)', 'en' => 'Urgent (under 1 month)'],
            '1_3m'      => ['ar' => '١ – ٣ أشهر', 'en' => '1 – 3 months'],
            '3_6m'      => ['ar' => '٣ – ٦ أشهر', 'en' => '3 – 6 months'],
            'flexible'  => ['ar' => 'مرن', 'en' => 'Flexible'],
        ],
    ],
];
