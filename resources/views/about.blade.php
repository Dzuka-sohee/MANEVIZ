@extends('layouts.app2')

@section('content')

<style>
    /* Reset dan Base Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: white;
        color: #333;
        line-height: 1.6;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .header {
        text-align: left;
        margin-bottom: 30px;
        margin-top: 20px;
    }

    .header h1 {
        font-size: 2.5em;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .content-wrapper {
        display: flex;
        gap: 40px;
        align-items: flex-start;
        margin-bottom: 30px;
    }

    .logo-section {
        flex: 0 0 350px;
        padding: 40px 20px;
        text-align: center;
        min-height: 300px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .logo-container {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .logo-image {
        width: 100%;
        max-width: 400px;
        height: auto;
        object-fit: contain;
    }

    .text-section {
        flex: 1;
        padding-left: 20px;
    }

    .text-content {
        font-size: 0.95em;
        text-align: justify;
        margin-bottom: 20px;
        color: #444;
    }

    .text-content p {
        margin-bottom: 15px;
    }

    .highlight {
        font-weight: bold;
        color: #000;
    }

    .additional-content {
        margin-top: 20px;
    }

    .additional-content p {
        margin-bottom: 15px;
        font-size: 0.95em;
        color: #444;
        text-align: justify;
    }

    .footer-text {
        margin-top: 30px;
        font-style: italic;
        color: #666;
        font-size: 0.9em;
    }

    /* Large Desktop */
    @media (max-width: 1400px) {
        .container {
            max-width: 1100px;
            padding: 20px 15px;
        }
    }

    /* Desktop */
    @media (max-width: 1200px) {
        .container {
            max-width: 1000px;
            padding: 20px 15px;
        }

        .content-wrapper {
            gap: 35px;
        }

        .logo-section {
            flex: 0 0 320px;
        }

        .logo-image {
            max-width: 350px;
        }
    }

    /* Large Tablet */
    @media (max-width: 1024px) {
        .container {
            padding: 20px 15px;
        }

        .content-wrapper {
            gap: 30px;
        }

        .logo-section {
            flex: 0 0 300px;
            padding: 30px 15px;
        }

        .logo-image {
            max-width: 320px;
        }

        .header h1 {
            font-size: 2.2em;
        }

        .text-content,
        .additional-content p {
            font-size: 0.92em;
        }
    }

    /* Medium Tablet */
    @media (max-width: 900px) {
        .container {
            padding: 18px 12px;
        }

        .content-wrapper {
            gap: 25px;
        }

        .logo-section {
            flex: 0 0 280px;
            padding: 25px 12px;
            min-height: 280px;
        }

        .logo-image {
            max-width: 300px;
        }

        .header h1 {
            font-size: 2.1em;
        }

        .text-content,
        .additional-content p {
            font-size: 0.9em;
        }
    }

    /* Small Tablet / Large Mobile */
    @media (max-width: 768px) {
        .container {
            padding: 15px 10px;
        }

        .content-wrapper {
            flex-direction: column;
            gap: 20px;
        }

        .logo-section {
            flex: none;
            width: 100%;
            margin-bottom: 20px;
            padding: 20px 10px;
            min-height: 250px;
        }

        .logo-image {
            max-width: 280px;
        }

        .text-section {
            padding-left: 0;
            width: 100%;
        }

        .header {
            margin-top: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .header h1 {
            font-size: 2em;
        }

        .text-content,
        .additional-content p {
            font-size: 0.9em;
            text-align: left;
            line-height: 1.7;
        }

        .additional-content {
            margin-top: 15px;
        }
    }

    /* Medium Mobile */
    @media (max-width: 640px) {
        .container {
            padding: 12px 8px;
        }

        .header h1 {
            font-size: 1.8em;
            margin-bottom: 15px;
        }

        .logo-section {
            padding: 18px 8px;
            min-height: 220px;
        }

        .logo-image {
            max-width: 260px;
        }

        .text-content,
        .additional-content p {
            font-size: 0.88em;
            margin-bottom: 14px;
            line-height: 1.6;
        }

        .content-wrapper {
            gap: 18px;
        }
    }

    /* Small Mobile */
    @media (max-width: 480px) {
        .container {
            padding: 10px 8px;
        }

        .header h1 {
            font-size: 1.6em;
            margin-bottom: 15px;
        }

        .logo-section {
            padding: 15px 5px;
            min-height: 200px;
        }

        .logo-image {
            max-width: 240px;
        }

        .text-content,
        .additional-content p {
            font-size: 0.85em;
            margin-bottom: 12px;
            line-height: 1.6;
        }

        .content-wrapper {
            gap: 15px;
        }

        .additional-content {
            margin-top: 12px;
        }
    }

    /* Extra Small Mobile */
    @media (max-width: 400px) {
        .container {
            padding: 8px 6px;
        }

        .header h1 {
            font-size: 1.4em;
            margin-bottom: 12px;
            margin-top: 90px;
        }

        .logo-section {
            padding: 12px 4px;
            min-height: 180px;
        }

        .logo-image {
            max-width: 220px;
        }

        .text-content,
        .additional-content p {
            font-size: 0.82em;
            margin-bottom: 11px;
            line-height: 1.5;
        }

        .content-wrapper {
            gap: 12px;
        }
    }

    /* Very Small Mobile */
    @media (max-width: 320px) {
        .container {
            padding: 6px 4px;
        }

        .header h1 {
            font-size: 1.3em;
            margin-bottom: 10px;
        }

        .logo-section {
            padding: 10px 2px;
            min-height: 160px;
        }

        .logo-image {
            max-width: 200px;
        }

        .text-content,
        .additional-content p {
            font-size: 0.8em;
            margin-bottom: 10px;
            line-height: 1.5;
        }

        .content-wrapper {
            gap: 10px;
        }
    }

    /* Landscape Mobile */
    @media (max-height: 500px) and (orientation: landscape) {
        .container {
            padding: 10px 15px;
        }

        .header {
            margin-top: 5px;
            margin-bottom: 15px;
        }

        .header h1 {
            font-size: 1.6em;
            margin-bottom: 10px;
        }

        .content-wrapper {
            flex-direction: row;
            gap: 20px;
        }

        .logo-section {
            flex: 0 0 200px;
            min-height: 150px;
            padding: 10px 5px;
        }

        .logo-image {
            max-width: 180px;
        }

        .text-content,
        .additional-content p {
            font-size: 0.8em;
            line-height: 1.4;
        }
    }

    /* High DPI / Retina Displays */
    @media (-webkit-min-device-pixel-ratio: 2),
    (min-resolution: 192dpi) {

        .text-content,
        .additional-content p {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    }

    /* Print Styles */
    @media print {
        .container {
            max-width: none;
            padding: 0;
        }

        .content-wrapper {
            flex-direction: column;
            gap: 20px;
        }

        .logo-section {
            flex: none;
            width: 100%;
            padding: 20px 0;
        }

        .text-content,
        .additional-content p {
            font-size: 12pt;
            color: black;
        }
    }
</style>

<div class="container">
    <div class="header">
        <h1>About Us</h1>
    </div>

    <div class="content-wrapper">
        <div class="logo-section">
            <div class="logo-container">
                <img src="image/about.jpg" alt="MANEVIZ Logo" class="logo-image">
            </div>
        </div>

        <div class="text-section">
            <div class="text-content">
                <p><span class="highlight">MANEVIZ</span> Was Born In The Heart Of Malang, A City Known For Its Creative Spirit And Youthful Energy. Founded By A Vocational High School Student With A Fierce Desire To Build Something Meaningful, <span class="highlight">MANEVIZ</span> Began As More Than Just A Fashion Project—It Was A Personal Mission. In A Time When Meets An Still Figuring Things Out, This Young Founder Chose To Take A Leap Into The World Of Fashion, Driven By A Simple Yet Powerful Belief: That Great Style And Authentic Expression Can Happen When Vision Meets Courage—Proof That Age Is No Barrier To Building A Legacy.</p>

                <p>Deeply Inspired By The Wild Worlds Of Anime, <span class="highlight">MANEVIZ</span> Embodies Character Transformation Seen In Its Stories Into Every Design. We See Anime Not Just As Entertainment, But As An Art Form That Mirrors Real Life The Battles We Fight Within, The Identities We Try To Define, The Dreams We Chase. Our Clothing Becomes A Medium For That Same Transformation—Rich In Symbolism, Bold Graphic Language, And Emotional Resonance. Each Piece Is Crafted To Echo The Spirit Of Heroes Who Rise From Chaos, Who Embrace Their Flaws, And Who Refuse To Be Ordinary.</p>
            </div>
        </div>
    </div>

    <div class="additional-content">
        <p>But <span class="highlight">MANEVIZ</span> Is Not Just About Design—It's About Expression. It's About Giving Gen-Z A Platform To Wear Their Stories, Their Emotions, Their Beliefs. Every Shirt Is More Than Fabric; It's A Statement. Every Hoodie Is More Than Warmth; It's An Armor Against A World That Often Feels Like Fashion And Feeling, Who Find Power In Standing Out Instead Of Fitting In. With Drops That Feel Raw And Real, <span class="highlight">MANEVIZ</span> Isn't Interested In Trends—We're Here To Shape Culture, To Speak To Those Who Refuse To Whisper.</p>

        <p>As A Movement Born From A Bedroom In Malang And Driven By The Pulse Of Youth Culture, <span class="highlight">MANEVIZ</span> Stands For All Who Believe In Starting Small But Dreaming Wide. We Are Here For The Creators, The Artists, The Makers, And The Believers. In Every Thread, There Is Intention. In Every Collection's A Narrative. And Behind It All, A Belief That Style Can Be Rebellion—And Clothing Can Carry The Soul.</p>

        <p><span class="highlight">MANEVIZ</span> — Born In Malang. Forged By Vision. Styled Through Chaos. Inspired By Anime. Created For Gen Z.</p>
    </div>
</div>

@endsection