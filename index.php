<?php
/*
* KEYAUTH.CC PHP EXAMPLE
*
* Edit credentials.php file and enter name & ownerid from https://keyauth.cc/app
*
* READ HERE TO LEARN ABOUT KEYAUTH FUNCTIONS https://github.com/KeyAuth/KeyAuth-PHP-Example#keyauthapp-instance-definition
*
*/
include 'keyauth.php';
include 'credentials.php';

if (isset($_SESSION['user_data'])) {
    header("Location: dashboard/");
    exit();
}

$KeyAuthApp = new KeyAuth\api($name, $ownerid);

if (!isset($_SESSION['sessionid'])) {
    $KeyAuthApp->init();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ghost - Premium Discord Tool</title>
    <link rel="icon" type="image/png" href="https://pub-e703fe367d8f47ddbffdb6e77e503192.r2.dev/K_logo.ico">
        <!-- SEO Meta Tags -->
    <meta name="description" content="Ghost is a premium Discord tool designed for advanced moderation and automation.">
    <meta name="keywords" content="Discord, Ghost, premium tool, Discord bot, automation, moderation">
    <meta name="author" content="YourNameOrCompany">

    <!-- Open Graph (for Facebook, Discord, etc.) -->
    <meta property="og:title" content="Ghost - Premium Discord Tool">
    <meta property="og:description" content="Advanced moderation and automation for Discord. Premium features and sleek design.">
    <meta property="og:image" content="https://pub-e703fe367d8f47ddbffdb6e77e503192.r2.dev/embed.png">
    <meta property="og:url" content="https://ghost.kempysnetwork.org">
    <meta property="og:type" content="website">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 50%, #0f0f0f 100%);
            min-height: 100vh;
            color: white;
            overflow-x: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.03) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Header */
        header {
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 1.5rem 0;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, #fff 0%, rgba(255, 255, 255, 0.7) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
            letter-spacing: 0.02em;
        }

        .nav-links a:hover {
            color: white;
        }

        /* Hero Section */
        .hero {
            padding: 8rem 0 6rem;
            text-align: center;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: clamp(3rem, 8vw, 6rem);
            font-weight: 800;
            margin-bottom: 1.5rem;
            letter-spacing: -0.04em;
            line-height: 1.1;
            background: linear-gradient(135deg, #fff 0%, rgba(255, 255, 255, 0.8) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 3rem;
            line-height: 1.6;
            font-weight: 400;
            letter-spacing: 0.01em;
        }

        .bot-preview {
            max-width: 800px;
            width: 100%;
            margin: 3rem auto 4rem;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .bot-preview img {
            width: 100%;
            height: auto;
            display: block;
            filter: brightness(1.1) contrast(1.05);
        }

        .preview-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 3rem auto 4rem;
            max-width: 900px;
        }

        .preview-item {
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .preview-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
        }

        .preview-item img {
            width: 100%;
            height: auto;
            display: block;
            filter: brightness(1.05) contrast(1.02);
        }

        .cta-button {
            display: inline-block;
            padding: 1.2rem 3rem;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            backdrop-filter: blur(20px);
            transition: all 0.3s ease;
            letter-spacing: 0.02em;
        }

        .cta-button:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        /* Features Section */
        .features {
            padding: 6rem 0;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 4rem;
            letter-spacing: -0.02em;
            color: rgba(255, 255, 255, 0.95);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 4rem;
        }

        .feature-card {
            padding: 2.5rem 2rem;
            text-align: center;
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.08);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 1.5rem;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            backdrop-filter: blur(10px);
        }

        .feature-card h3 {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: rgba(255, 255, 255, 0.95);
        }

        .feature-card p {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
            font-weight: 400;
        }

        /* Pricing Section */
        .pricing {
            padding: 6rem 0;
        }

        .pricing-card {
            max-width: 400px;
            margin: 0 auto;
            padding: 3rem 2.5rem;
            text-align: center;
        }

        .pricing-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .price {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            color: white;
        }

        .price-period {
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 2rem;
        }

        .pricing-features {
            list-style: none;
            margin: 2rem 0;
        }

        .pricing-features li {
            padding: 0.5rem 0;
            color: rgba(255, 255, 255, 0.8);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .pricing-features li:last-child {
            border-bottom: none;
        }

        /* FAQ Section */
        .faq {
            padding: 6rem 0;
        }

        .faq-item {
            margin-bottom: 1.5rem;
            padding: 2rem;
        }

        .faq-question {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: rgba(255, 255, 255, 0.95);
        }

        .faq-answer {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
        }

        /* Footer */
        footer {
            padding: 4rem 0 2rem;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-content {
            padding: 2rem;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-bottom {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 0 1rem;
            }
            
            .nav-links {
                display: none;
            }
            
            .hero {
                padding: 4rem 0;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .footer-links {
                flex-direction: column;
                gap: 1rem;
            }
        }

        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="glass">
        <nav class="container">
            <div class="logo">Ghost</div>
            <ul class="nav-links">
                <li><a href="#features">Features</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Ghost Premium</h1>
                <p>Everything you need from a Discord Tool. Since 2020, Ghost has been delivering the ultimate Discord experience with original, unique features that users love. Join the leader in the selfbot market.</p>
                
                <div class="bot-preview">
                    <img src="https://pub-e703fe367d8f47ddbffdb6e77e503192.r2.dev/image_2025-08-06_215755836.png" alt="Ghost Discord Tool Interface Preview" />
                </div>
                <div class="bot-preview">
                    <img src="https://pub-e703fe367d8f47ddbffdb6e77e503192.r2.dev/embed.png" alt="Ghost Discord Tool Embed Preview" />
                </div>

                <div class="preview-gallery">
                    <div class="preview-item">
                        <img src="https://pub-e703fe367d8f47ddbffdb6e77e503192.r2.dev/Screenshot%202025-08-06%20220141.png" alt="Ghost Advanced Commands" />
                    </div>
                    <div class="preview-item">
                        <img src="https://pub-e703fe367d8f47ddbffdb6e77e503192.r2.dev/Screenshot%202025-08-06%20220202.png" alt="Ghost Automation Features" />
                    </div>
                    <div class="preview-item">
                        <img src="https://pub-e703fe367d8f47ddbffdb6e77e503192.r2.dev/Screenshot%202025-08-06%20220217.png" alt="Ghost Custom Scripts Interface" />
                    </div>
                </div>
                
                <a href="#pricing" class="cta-button">Buy Now</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <h2 class="section-title">Powerful Features</h2>
            <div class="features-grid">
                <div class="feature-card glass">
                    <div class="feature-icon">⚡</div>
                    <h3>Advanced Commands</h3>
                    <p>Wide range of commands from server administration and image generation to account protection and fun features. Everything you need in one tool.</p>
                </div>
                <div class="feature-card glass">
                    <div class="feature-icon">🤖</div>
                    <h3>AI Features & Automation</h3>
                    <p>Powerful automations including auto-translate, auto-slash commands, and AI-powered features to enhance your Discord experience.</p>
                </div>
                <div class="feature-card glass">
                    <div class="feature-icon">🎯</div>
                    <h3>Joiners & Snipers</h3>
                    <p>Giveaway Joiner and Nitro Sniper with millisecond response times. Support for unlimited alt accounts to boost your chances.</p>
                </div>
                <div class="feature-card glass">
                    <div class="feature-icon">🔧</div>
                    <h3>Custom Scripts Engine</h3>
                    <p>Create your own features using Python or explore community-made scripts. No coding experience required with pre-made solutions.</p>
                </div>
                <div class="feature-card glass">
                    <div class="feature-icon">🛡️</div>
                    <h3>Privacy & Safety</h3>
                    <p>100% safety guaranteed. All data stored locally on your computer. Operates as a real Discord client for maximum security.</p>
                </div>
                <div class="feature-card glass">
                    <div class="feature-icon">🎨</div>
                    <h3>Highly Customizable</h3>
                    <p>Full customization from command responses to feature settings. Use the theme builder and explore community content ready to download.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing" id="pricing">
        <div class="container">
            <h2 class="section-title">Ghost Pricing</h2>
            <div class="pricing-card glass">
                <div class="pricing-badge">Most Popular</div>
                <div class="price">$5.99</div>
                <div class="price-period">per month</div>
                <ul class="pricing-features">
                    <li>✓ All Advanced Commands</li>
                    <li>✓ AI Features & Automation</li>
                    <li>✓ Joiners & Snipers</li>
                    <li>✓ Custom Scripts Engine</li>
                    <li>✓ 100% Safety Guaranteed</li>
                    <li>✓ Unlimited Customization</li>
                    <li>✓ Community Scripts Access</li>
                    <li>✓ Priority Support</li>
                </ul>
                <a href="https://discord.com/users/1206971103612768317" class="cta-button">Buy Now</a>
            </div>
        
            <div class="pricing-card glass">
                <div class="pricing-badge">New Lifetime</div>
                <div class="price">$159.99</div>
                <div class="price-period">pay once</div>
                <ul class="pricing-features">
                    <li>✓ All Advanced Commands</li>
                    <li>✓ AI Features & Automation</li>
                    <li>✓ Joiners & Snipers</li>
                    <li>✓ Custom Scripts Engine</li>
                    <li>✓ 100% Safety Guaranteed</li>
                    <li>✓ Unlimited Customization</li>
                    <li>✓ Community Scripts Access</li>
                    <li>✓ Priority Support</li>
                </ul>
                <a href="https://discord.com/users/1206971103612768317" class="cta-button">Buy Now</a>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq" id="faq">
        <div class="container">
            <h2 class="section-title">Frequently Asked Questions</h2>
            <div class="faq-item glass">
                <h3 class="faq-question">How do I get started with Ghost?</h3>
                <p class="faq-answer">After subscribing, you'll receive download instructions and setup guide. Ghost installs as a local application on your computer for maximum privacy and security.</p>
            </div>
            <div class="faq-item glass">
                <h3 class="faq-question">Is Ghost safe to use?</h3>
                <p class="faq-answer">Yes! Ghost has been tested extensively since 2020 and guarantees 100% safety. It operates as a real Discord client device and stores all data locally on your computer.</p>
            </div>
            <div class="faq-item glass">
                <h3 class="faq-question">Can I create custom features?</h3>
                <p class="faq-answer">Absolutely! Ghost includes a Custom Scripts Engine that lets you create features using Python, or you can download community-made scripts instantly.</p>
            </div>
            <div class="faq-item glass">
                <h3 class="faq-question">What makes Ghost different from other Discord tools?</h3>
                <p class="faq-answer">Since 2020, Ghost has been the leader in the selfbot market with original, unique features. We offer advanced commands, powerful automations, joiners & snipers, and complete customization.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="container">
            <div class="footer-content glass">
                <div class="footer-links">
                    <a href="https://discord.com/users/1206971103612768317">Support</a>
                    <a href="https://discord.com/users/1206971103612768317">Discord</a>
                </div>
                <div class="footer-bottom">
                    <p>&copy; 2025 Ghost. All rights reserved. | KempysNetwork.org</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>