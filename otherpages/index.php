<?php include 'header.php'; ?>

<div class="container mt-5">
  <h2><i class="fas fa-question-circle text-primary me-2"></i>Frequently Asked Questions (FAQs)</h2>
  <div class="accordion mt-4" id="faqAccordion">

    <!-- FAQ 1 -->
    <div class="accordion-item bg-dark text-light border-0 mb-2">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
          <i class="fas fa-book-open me-2 text-info"></i>How do I borrow a book?
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          To borrow a book, browse the catalog, select the desired book, and click the "Borrow" button. You will be asked to choose between Hardcover (read online) or eBook (download).
        </div>
      </div>
    </div>

    <!-- FAQ 2 -->
    <div class="accordion-item bg-dark text-light border-0 mb-2">
      <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
          <i class="fas fa-user-lock me-2 text-info"></i>Do I need an account to access books?
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Yes, you need to register and log in to access, borrow, or download books. Guest access is limited to viewing available titles.
        </div>
      </div>
    </div>

    <!-- FAQ 3 -->
    <div class="accordion-item bg-dark text-light border-0 mb-2">
      <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
          <i class="fas fa-file-pdf me-2 text-info"></i>Can I download books?
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Yes, eBooks in PDF format are available for download after admin approval and payment (if applicable).
        </div>
      </div>
    </div>

    <!-- FAQ 4 -->
    <div class="accordion-item bg-dark text-light border-0 mb-2">
      <h2 class="accordion-header" id="headingFour">
        <button class="accordion-button collapsed bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
          <i class="fas fa-truck me-2 text-info"></i>How does shipping work?
        </button>
      </h2>
      <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          For physical books, shipping is free for premium members. Standard delivery time is 3–7 days. You will receive tracking information once dispatched.
        </div>
      </div>
    </div>

    <!-- FAQ 5 -->
    <div class="accordion-item bg-dark text-light border-0 mb-2">
      <h2 class="accordion-header" id="headingFive">
        <button class="accordion-button collapsed bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
          <i class="fas fa-sync-alt me-2 text-info"></i>What if I need to return a book?
        </button>
      </h2>
      <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          You can return books through the “My Borrowed Books” section. Follow the return instructions provided. eBooks cannot be returned after download.
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
