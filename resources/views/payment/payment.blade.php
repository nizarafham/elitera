<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <link rel="stylesheet" href="/css/payment.css" />
    <title>E-Litera</title>
  </head>
  <body>
    <nav>
      <div class="nav__header">
        <div class="nav__logo">
          <a href="/daftar/daftar.html">E-Litera<span>.</span></a>
        </div>
        <div class="nav__menu__btn" id="menu-btn">
          <i class="ri-menu-line"></i>
        </div>
      </div>
      <ul class="nav__links" id="nav-links">
        <li><a href="#home">Home</a></li>
        <li><a href="#intro">Intro</a></li>
        <li><a href="#popular-courses">Popular Courses</a></li>
        <li><a href="#client">Clients</a></li>
        <li><a href="#blog">Blog</a></li>
      </ul>
      <div class="nav__btns">
        <button class="btn"><a href="/daftar/daftar.html" style="font-weight: bold;" >Subscribe</a></button>
      </div>
    </nav>

    <div class="payment-container">
    <button id="openModal" class="open-modal-btn">Bayar Sekarang</button>

    <!-- Modal -->
    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Transaksi Pembayaran</h2>

            <!-- Order Summary -->
            <div class="order-summary">
                <h3>Ringkasan Pesanan</h3>
                <p>Nama Kursus: <strong>Belajar Pemrograman</strong></p>
                <p>Harga: <strong>Rp500.000</strong></p>
                <p>Biaya Admin: <strong>Rp5.000</strong></p>
                <p id="promoDiscount" class="hidden">Diskon Promo: <strong>Rp0</strong></p>
                <p><strong>Total: <span id="totalPrice">Rp505.000</span></strong></p>
            </div>

            <!-- Promo Code -->
            <div class="promo-section">
                <label for="promoCode">Kode Promo:</label>
                <input type="text" id="promoCode" placeholder="Masukkan kode promo">
                <button id="applyPromo" class="promo-btn">Terapkan</button>
            </div>

            <!-- Payment Methods -->
            <form id="paymentForm">
                <h3>Pilih metode pembayaran:</h3>
                <label>
                    <input type="radio" name="payment-method" value="credit-card">
                    Kartu Kredit/Debit
                </label><br>
                <label>
                    <input type="radio" name="payment-method" value="e-wallet">
                    E-Wallet
                </label><br>
                <label>
                    <input type="radio" name="payment-method" value="bank-transfer">
                    Transfer Bank
                </label><br>

                <!-- Credit/Debit Options -->
                <div id="creditCardOptions" class="hidden">
                    <p>Pilih Bank:</p>
                    <select id="creditCardBank">
                        <option value="">Pilih Bank</option>
                        <option value="bca">BCA</option>
                        <option value="mandiri">Mandiri</option>
                        <option value="bni">BNI</option>
                    </select>
                    <p>Masukkan Nomor Kartu:</p>
                    <input type="text" id="cardNumber" placeholder="Nomor Kartu">
                </div>

                <!-- E-Wallet Options -->
                <div id="eWalletOptions" class="hidden">
                    <p>Pilih E-Wallet:</p>
                    <select id="eWalletSelect">
                        <option value="">Pilih</option>
                        <option value="ovo">OVO</option>
                        <option value="dana">Dana</option>
                        <option value="gopay">Gopay</option>
                    </select>
                    <p>Masukkan Nomor E-Wallet:</p>
                    <input type="text" id="walletNumber" placeholder="Nomor E-Wallet">
                    <p>Atau Scan Barcode:</p>
                    <img id="eWalletBarcode" src="barcode-placeholder.png" alt="Barcode" class="hidden">
                </div>

                <!-- Bank Transfer Options -->
                <div id="bankTransferOptions" class="hidden">
                    <p>Pilih Bank:</p>
                    <select id="bankTransferSelect">
                        <option value="">Pilih</option>
                        <option value="bca">BCA</option>
                        <option value="mandiri">Mandiri</option>
                        <option value="bri">BRI</option>
                    </select>
                    <p>Atau Scan Barcode:</p>
                    <img id="bankTransferBarcode" src="barcode-placeholder.png" alt="Barcode" class="hidden">
                </div>

                <button type="submit" class="submit-btn">Konfirmasi</button>
            </form>
        </div>
    </div>
</div>

      


    <footer>
        <div class="footer-container">
          <div class="footer-section company-info">
            <h2>Edtech</h2>
            <p><i class="fa fa-phone"></i> +998 7364 5867</p>
            <p><i class="fa fa-envelope"></i> e-litera.course</p>
            <div class="social-icons">
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-instagram"></i></a>
              <a href="#"><i class="fa fa-linkedin"></i></a>
              <a href="#"><i class="fa fa-youtube"></i></a>
              <a href="#"><i class="fa fa-twitter"></i></a>
            </div>
          </div>
  
          <div class="footer-section menu">
            <h3>Menu</h3>
            <ul>
              <li><a href="#">Categories</a></li>
              <li><a href="#">Courses</a></li>
              <li><a href="#">Deals</a></li>
              <li><a href="#">New</a></li>
              <li><a href="#">Certificates</a></li>
            </ul>
          </div>
  
          <div class="footer-section company">
            <h3>Company</h3>
            <ul>
              <li><a href="#">About Us</a></li>
              <li><a href="#">News</a></li>
              <li><a href="#">Sell Courses</a></li>
              <li><a href="#">Mentor</a></li>
              <li><a href="#">Blog</a></li>
            </ul>
          </div>
  
          <div class="footer-section support">
            <h3>Support</h3>
            <ul>
              <li><a href="#">Security</a></li>
              <li><a href="#">Terms & Conditions</a></li>
              <li><a href="#">Career</a></li>
              <li><a href="#">Comments</a></li>
              <li><a href="#">Community</a></li>
            </ul>
          </div>
  
          <div class="footer-section newsletter">
            <h3>Subscribe to our Newsletter</h3>
            <form>
              <input type="email" placeholder="Enter your email" required />
              <button type="submit">Subscribe Now</button>
            </form>
          </div>
        </div>
        <div class="footer_bar">
          Copyright © 2025 E-Litera - Online Course.
        </div>
      </footer>
      
  
      <script src="https://unpkg.com/scrollreveal"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
      <script src="/js/payment.js"></script>
    </body>
  </html>
  