@extends ('layouts.app2')

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
    padding: 40px 20px;
    background-color: white;
}

.contact-section {
    display: grid;
    grid-template-columns: 1fr 2px 1fr;
    gap: 40px;
    align-items: start;
}

.divider {
    width: 2px;
    background-color: black;
    height: 600px;
    min-height: 500px;
    margin-top: 85px;
    border-radius: 20px;
    justify-self: center;
}

.form-section h1 {
    font-size: 2.5rem;
    font-weight: 600;
    margin-bottom: 20px;
    margin-top: 30px;
    color: #000;
}

.form-group {
    margin-bottom: 24px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #333;
    font-size: 0.95rem;
}

.required {
    color: #e74c3c;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #000000ff;
    border-radius: 4px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
    background-color: transparent;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #007bff;
}

.form-group select {
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 12px center;
    background-repeat: no-repeat;
    background-size: 16px;
    padding-right: 40px;
}

.form-group textarea {
    height: 120px;
    resize: vertical;
}

.submit-btn {
    background-color: #000;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 10px;
    width: auto;
    min-width: 120px;
}

.submit-btn:hover {
    background-color: #333;
}

.social-section {
    padding-top: 60px;
}

.social-section h2 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 15px;
    margin-top: 40px;
    color: #000;
}

.social-links {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
}

.social-link {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: #333;
    transition: all 0.3s ease;
    border: 1px solid #e1e1e1;
}

.social-link:hover {
    background-color: #000;
    color: white;
    transform: translateY(-2px);
}

.social-link svg {
    width: 20px;
    height: 20px;
}

/* Extra Large Desktop */
@media (min-width: 1400px) {
    .container {
        max-width: 1300px;
        padding: 60px 40px;
    }

    .contact-section {
        gap: 50px;
    }

    .form-section h1 {
        font-size: 2.8rem;
    }

    .divider {
        height: 650px;
        margin-top: 90px;
    }
}

/* Large Desktop */
@media (min-width: 1200px) and (max-width: 1399px) {
    .container {
        padding: 50px 30px;
    }

    .contact-section {
        gap: 45px;
    }

    .form-section h1 {
        font-size: 2.6rem;
    }

    .divider {
        height: 620px;
        margin-top: 88px;
    }
}

/* Desktop */
@media (max-width: 1199px) {
    .container {
        max-width: 1000px;
        padding: 40px 25px;
    }

    .contact-section {
        gap: 35px;
    }

    .form-section h1 {
        font-size: 2.4rem;
    }

    .divider {
        height: 580px;
        margin-top: 80px;
    }
}

/* Large Tablet */
@media (max-width: 1024px) {
    .container {
        padding: 35px 20px;
    }

    .contact-section {
        gap: 30px;
    }

    .form-section h1 {
        font-size: 2.2rem;
        margin-top: 25px;
    }

    .divider {
        height: 520px;
        margin-top: 70px;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 11px 15px;
        font-size: 0.98rem;
    }

    .social-section {
        padding-top: 50px;
    }

    .social-section h2 {
        margin-top: 35px;
        font-size: 1.4rem;
    }
}

/* Medium Tablet */
@media (max-width: 900px) {
    .container {
        padding: 30px 18px;
    }

    .contact-section {
        gap: 25px;
    }

    .form-section h1 {
        font-size: 2.1rem;
        margin-top: 20px;
    }

    .divider {
        height: 480px;
        margin-top: 65px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .social-section {
        padding-top: 40px;
    }

    .social-section h2 {
        margin-top: 30px;
        font-size: 1.35rem;
    }

    .social-links {
        gap: 14px;
    }
}

/* Tablet Portrait */
@media (max-width: 768px) {
    .container {
        padding: 25px 15px;
    }

    .contact-section {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .divider {
        display: none;
    }
    
    .form-section h1 {
        font-size: 2rem;
        margin-top: 15px;
        text-align: center;
    }
    
    .social-section {
        padding-top: 20px;
        border-top: 2px solid #f0f0f0;
        margin-top: 20px;
    }

    .social-section h2 {
        margin-top: 20px;
        text-align: center;
        font-size: 1.4rem;
    }

    .social-links {
        gap: 12px;
        justify-content: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 11px 14px;
        font-size: 0.96rem;
    }

    .submit-btn {
        width: 100%;
        padding: 14px 24px;
        font-size: 1.05rem;
    }
}

/* Large Mobile */
@media (max-width: 640px) {
    .container {
        padding: 20px 12px;
    }

    .form-section h1 {
        font-size: 1.9rem;
        margin-bottom: 18px;
        margin-top: 12px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        font-size: 0.93rem;
        margin-bottom: 7px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 10px 14px;
        font-size: 0.95rem;
    }

    .form-group textarea {
        height: 110px;
    }

    .form-group select {
        background-size: 15px;
        padding-right: 38px;
    }

    .social-section h2 {
        font-size: 1.3rem;
        margin-bottom: 12px;
    }

    .social-link {
        width: 44px;
        height: 44px;
    }

    .social-link svg {
        width: 21px;
        height: 21px;
    }

    .social-links {
        gap: 11px;
    }
}

/* Medium Mobile */
@media (max-width: 480px) {
    .container {
        padding: 15px 10px;
    }

    .form-section h1 {
        font-size: 1.7rem;
        margin-top: 10px;
        margin-bottom: 16px;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-group label {
        font-size: 0.9rem;
        margin-bottom: 6px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 10px 12px;
        font-size: 0.92rem;
    }

    .form-group textarea {
        height: 100px;
    }

    .form-group select {
        background-size: 14px;
        padding-right: 35px;
    }

    .submit-btn {
        padding: 12px 20px;
        font-size: 0.98rem;
    }

    .social-section {
        margin-top: 18px;
        padding-top: 18px;
    }

    .social-section h2 {
        font-size: 1.25rem;
        margin-top: 15px;
        margin-bottom: 12px;
    }

    .social-links {
        gap: 10px;
        justify-content: center;
    }

    .social-link {
        width: 42px;
        height: 42px;
    }

    .social-link svg {
        width: 20px;
        height: 20px;
    }
}

/* Small Mobile */
@media (max-width: 400px) {
    .container {
        padding: 12px 8px;
    }

    .form-section h1 {
        font-size: 1.5rem;
        margin-top: 8px;
        margin-bottom: 14px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        font-size: 0.88rem;
        margin-bottom: 5px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 9px 11px;
        font-size: 0.9rem;
    }

    .form-group textarea {
        height: 90px;
    }

    .form-group select {
        background-size: 13px;
        padding-right: 32px;
    }

    .submit-btn {
        padding: 11px 18px;
        font-size: 0.95rem;
    }

    .social-section h2 {
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    .social-link {
        width: 40px;
        height: 40px;
    }

    .social-link svg {
        width: 19px;
        height: 19px;
    }

    .social-links {
        gap: 9px;
    }
}

/* Extra Small Mobile */
@media (max-width: 360px) {
    .container {
        padding: 10px 6px;
    }

    .form-section h1 {
        font-size: 1.4rem;
        margin-top: 90px;
        margin-bottom: 12px;
    }

    .form-group {
        margin-bottom: 14px;
    }

    .form-group label {
        font-size: 0.85rem;
        margin-bottom: 5px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 8px 10px;
        font-size: 0.87rem;
    }

    .form-group textarea {
        height: 85px;
    }

    .form-group select {
        background-size: 12px;
        padding-right: 30px;
    }

    .submit-btn {
        padding: 10px 16px;
        font-size: 0.92rem;
    }

    .social-section {
        margin-top: 15px;
        padding-top: 15px;
        margin-bottom: 40px;
    }

    .social-section h2 {
        font-size: 1.15rem;
        margin-top: 12px;
        margin-bottom: 10px;
    }

    .social-link {
        width: 38px;
        height: 38px;
    }

    .social-link svg {
        width: 18px;
        height: 18px;
    }

    .social-links {
        gap: 8px;
    }
}

/* Very Small Mobile */
@media (max-width: 320px) {
    .container {
        padding: 8px 4px;
    }

    .form-section h1 {
        font-size: 1.3rem;
        margin-top: 5px;
        margin-bottom: 10px;
    }

    .form-group {
        margin-bottom: 12px;
    }

    .form-group label {
        font-size: 0.82rem;
        margin-bottom: 4px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 7px 9px;
        font-size: 0.85rem;
    }

    .form-group textarea {
        height: 80px;
    }

    .form-group select {
        background-size: 11px;
        padding-right: 28px;
    }

    .submit-btn {
        padding: 9px 14px;
        font-size: 0.9rem;
    }

    .social-section h2 {
        font-size: 1.1rem;
    }

    .social-link {
        width: 36px;
        height: 36px;
    }

    .social-link svg {
        width: 17px;
        height: 17px;
    }

    .social-links {
        gap: 7px;
    }
}

/* Landscape Mobile */
@media (max-height: 500px) and (orientation: landscape) {
    .container {
        padding: 15px 20px;
    }
    
    .form-section h1 {
        font-size: 1.6rem;
        margin-top: 8px;
        margin-bottom: 12px;
    }

    .form-group {
        margin-bottom: 12px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 8px 12px;
        font-size: 0.9rem;
    }

    .form-group textarea {
        height: 70px;
    }

    .submit-btn {
        padding: 8px 16px;
        font-size: 0.9rem;
    }

    .social-section {
        padding-top: 12px;
        margin-top: 12px;
    }

    .social-section h2 {
        margin-top: 8px;
        margin-bottom: 8px;
        font-size: 1.2rem;
    }

    .social-link {
        width: 35px;
        height: 35px;
    }

    .social-link svg {
        width: 16px;
        height: 16px;
    }

    .social-links {
        gap: 8px;
    }
}

/* High DPI / Retina Displays */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .form-group input,
    .form-group select,
    .form-group textarea,
    .form-group label,
    .form-section h1,
    .social-section h2 {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
}

/* Print Styles */
@media print {
    .container {
        max-width: none;
        padding: 20px 0;
    }

    .contact-section {
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .divider {
        display: none;
    }

    .social-section {
        border-top: 1px solid #000;
        padding-top: 20px;
    }

    .social-links {
        display: none;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        border: 2px solid #000;
        background: white;
    }

    .submit-btn {
        background: white;
        border: 2px solid #000;
        color: #000;
    }
}
</style>

<div class="container">
    <div class="contact-section">
        <div class="form-section">
            <h1>Contact Us</h1>
            <form>
                <div class="form-group">
                    <label for="name">Name<span class="required">*</span></label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone<span class="required">*</span></label>
                    <input type="tel" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="subject">Subject<span class="required">*</span></label>
                    <select id="subject" name="subject" required>
                        <option value="">Select a subject</option>
                        <option value="general">General Inquiry</option>
                        <option value="support">Customer Support</option>
                        <option value="sales">Sales Question</option>
                        <option value="partnership">Partnership</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="message">Message<span class="required">*</span></label>
                    <textarea id="message" name="message" placeholder="Your message here..." required></textarea>
                </div>

                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>

        <div class="divider"></div>

        <div class="social-section">
            <h2>Find Us On</h2>
            <div class="social-links">
                <a href="#" class="social-link" title="WhatsApp">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884M20.556 3.442C18.237 1.12 15.163.001 12.05.001 5.463.001.104 5.359.101 11.946a11.806 11.806 0 001.57 5.91L0 24l6.331-1.658a11.861 11.861 0 005.682 1.449h.005c6.587 0 11.945-5.359 11.948-11.946-.001-3.192-1.242-6.196-3.51-8.403"/>
                    </svg>
                </a>
                <a href="#" class="social-link" title="Website">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                    </svg>
                </a>
                <a href="#" class="social-link" title="Instagram">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                </a>
                <a href="#" class="social-link" title="Discord">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028 14.09 14.09 0 0 0 1.226-1.994.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.892.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418Z"/>
                    </svg>
                </a>
                <a href="#" class="social-link" title="TikTok">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-.88-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                    </svg>
                </a>
                <a href="#" class="social-link" title="Twitter/X">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                    </svg>
                </a>
                <a href="#" class="social-link" title="YouTube">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Simple form validation
        const name = document.getElementById('name').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const subject = document.getElementById('subject').value;
        const message = document.getElementById('message').value.trim();
        
        if (!name || !phone || !subject || !message) {
            alert('Please fill in all required fields.');
            return;
        }
        
        alert('Form submitted successfully!');
        
        // Reset form after successful submission
        this.reset();
    });

    // Add input validation feedback
    document.querySelectorAll('input, select, textarea').forEach(input => {
        input.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) {
                this.style.borderColor = '#e74c3c';
            } else {
                this.style.borderColor = '#000000ff';
            }
        });
        
        input.addEventListener('input', function() {
            if (this.hasAttribute('required') && this.value.trim()) {
                this.style.borderColor = '#28a745';
            }
        });
    });
</script>

@endsection