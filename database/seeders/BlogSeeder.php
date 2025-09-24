<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\User;
use Carbon\Carbon;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the admin user or create one if it doesn't exist
        $adminUser = User::where('email', 'admin@example.com')->first();
        if (!$adminUser) {
            $adminUser = User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

        $blogs = [
            [
                'title_ar' => 'أهمية الهوية البصرية في بناء العلامة التجارية',
                'title_en' => 'The Importance of Visual Identity in Building Brand',
                'slug' => 'importance-visual-identity-branding',
                'content_ar' => 'الهوية البصرية هي أول ما يراه العملاء من علامتك التجارية. تشمل الشعار والألوان والخطوط والصور التي تمثل شخصية علامتك التجارية. في عالم اليوم الرقمي، أصبحت الهوية البصرية أكثر أهمية من أي وقت مضى لأنها تساعد في بناء الثقة والتعرف على العلامة التجارية.

                        عندما نتحدث عن الهوية البصرية، نعني كل العناصر المرئية التي تميز علامتك التجارية عن المنافسين. هذا يشمل:
                        - الشعار والعلامة التجارية
                        - نظام الألوان المحدد
                        - الخطوط والطباعة
                        - الصور والرسوم التوضيحية
                        - التصميم العام للمواد التسويقية

                        في شركة الوفاق، نؤمن بأن الهوية البصرية القوية هي أساس نجاح أي علامة تجارية في السوق السعودي.',
                'content_en' => 'Visual identity is the first thing customers see from your brand. It includes the logo, colors, fonts, and images that represent your brand personality. In today\'s digital world, visual identity has become more important than ever as it helps build trust and brand recognition.

                        When we talk about visual identity, we mean all the visual elements that distinguish your brand from competitors. This includes:
                        - Logo and branding
                        - Specific color system
                        - Fonts and typography
                        - Images and illustrations
                        - Overall design of marketing materials

                        At Al Wifak, we believe that a strong visual identity is the foundation of any brand\'s success in the Saudi market.',
                'excerpt_ar' => 'تعرف على أهمية الهوية البصرية في بناء علامة تجارية قوية ومميزة في السوق السعودي.',
                'excerpt_en' => 'Learn about the importance of visual identity in building a strong and distinctive brand in the Saudi market.',
                'author_id' => $adminUser->id,
                'published_at' => Carbon::now()->subDays(30),
                'status' => 'published',
                'image' => 'blog-visual-identity.jpg',
            ],
            [
                'title_ar' => 'استراتيجيات التسويق الرقمي لعام 2024',
                'title_en' => 'Digital Marketing Strategies for 2024',
                'slug' => 'digital-marketing-strategies-2024',
                'content_ar' => 'مع تطور التكنولوجيا وتغير سلوك المستهلكين، أصبح التسويق الرقمي أداة أساسية لنجاح أي عمل تجاري. في عام 2024، هناك العديد من الاستراتيجيات الجديدة والمبتكرة التي يجب على الشركات تبنيها.

                        الاستراتيجيات الرئيسية لعام 2024 تشمل:
                        1. التسويق بالمحتوى المرئي
                        2. استخدام الذكاء الاصطناعي في التسويق
                        3. التسويق عبر وسائل التواصل الاجتماعي الجديدة
                        4. تحسين تجربة العملاء الرقمية
                        5. التسويق المستدام والمسؤول اجتماعياً

                        في شركة الوفاق، نساعد عملاءنا في تطوير وتنفيذ هذه الاستراتيجيات لتحقيق أفضل النتائج.',
                'content_en' => 'With the evolution of technology and changing consumer behavior, digital marketing has become an essential tool for the success of any business. In 2024, there are many new and innovative strategies that companies should adopt.

                        The main strategies for 2024 include:
                        1. Visual content marketing
                        2. Using artificial intelligence in marketing
                        3. Marketing through new social media platforms
                        4. Improving digital customer experience
                        5. Sustainable and socially responsible marketing

                        At Al Wifak, we help our clients develop and implement these strategies to achieve the best results.',
                'excerpt_ar' => 'اكتشف أحدث استراتيجيات التسويق الرقمي لعام 2024 وكيفية تطبيقها في عملك.',
                'excerpt_en' => 'Discover the latest digital marketing strategies for 2024 and how to apply them in your business.',
                'author_id' => $adminUser->id,
                'published_at' => Carbon::now()->subDays(15),
                'status' => 'published',
                'image' => 'blog-digital-marketing-2024.jpg',
            ],
            [
                'title_ar' => 'دور وسائل التواصل الاجتماعي في التسويق الحديث',
                'title_en' => 'The Role of Social Media in Modern Marketing',
                'slug' => 'role-social-media-modern-marketing',
                'content_ar' => 'أصبحت وسائل التواصل الاجتماعي جزءاً لا يتجزأ من حياة الناس اليومية، وبالتالي أصبحت أداة تسويقية قوية للوصول إلى العملاء المحتملين. في المملكة العربية السعودية، يستخدم ملايين الأشخاص وسائل التواصل الاجتماعي يومياً.

                        المنصات الرئيسية تشمل:
                        - تويتر (إكس)
                        - إنستغرام
                        - سناب شات
                        - تيك توك
                        - لينكد إن للأعمال

                        كل منصة لها خصائصها الفريدة وجمهورها المستهدف. في شركة الوفاق، نطور استراتيجيات مخصصة لكل منصة لتحقيق أقصى استفادة من وجودك الرقمي.',
                'content_en' => 'Social media has become an integral part of people\'s daily lives, and therefore has become a powerful marketing tool to reach potential customers. In Saudi Arabia, millions of people use social media daily.

                        The main platforms include:
                        - Twitter (X)
                        - Instagram
                        - Snapchat
                        - TikTok
                        - LinkedIn for business

                        Each platform has its unique characteristics and target audience. At Al Wifak, we develop customized strategies for each platform to maximize the benefit of your digital presence.',
                'excerpt_ar' => 'تعرف على كيفية استخدام وسائل التواصل الاجتماعي بفعالية في استراتيجيات التسويق الحديث.',
                'excerpt_en' => 'Learn how to effectively use social media in modern marketing strategies.',
                'author_id' => $adminUser->id,
                'published_at' => Carbon::now()->subDays(7),
                'status' => 'published',
                'image' => 'blog-social-media-marketing.jpg',
            ],
            [
                'title_ar' => 'تصميم تجربة المستخدم في المواقع الإلكترونية',
                'title_en' => 'User Experience Design in Websites',
                'slug' => 'user-experience-design-websites',
                'content_ar' => 'تصميم تجربة المستخدم (UX) هو علم وفن تصميم المواقع والتطبيقات بطريقة تجعل التفاعل معها سهلاً وممتعاً. في عصرنا الحالي، أصبح المستخدمون أكثر تطلباً وأقل صبراً، لذلك يجب أن تكون تجربة المستخدم استثنائية.

                        العناصر الرئيسية في تصميم UX:
                        1. سهولة الاستخدام
                        2. سرعة التحميل
                        3. التصميم المتجاوب
                        4. التنقل السهل
                        5. المحتوى الواضح والمفيد

                        في شركة الوفاق، نركز على تصميم تجارب مستخدم استثنائية تساعد عملاءنا في تحقيق أهدافهم التجارية.',
                'content_en' => 'User Experience Design (UX) is the science and art of designing websites and applications in a way that makes interaction with them easy and enjoyable. In our current era, users have become more demanding and less patient, so the user experience must be exceptional.

                        Key elements in UX design:
                        1. Ease of use
                        2. Loading speed
                        3. Responsive design
                        4. Easy navigation
                        5. Clear and useful content

                        At Al Wifak, we focus on designing exceptional user experiences that help our clients achieve their business goals.',
                'excerpt_ar' => 'اكتشف أساسيات تصميم تجربة المستخدم وأهميتها في نجاح المواقع الإلكترونية.',
                'excerpt_en' => 'Discover the basics of user experience design and its importance in website success.',
                'author_id' => $adminUser->id,
                'published_at' => Carbon::now()->subDays(3),
                'status' => 'published',
                'image' => 'blog-ux-design.jpg',
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}
