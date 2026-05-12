document.addEventListener("DOMContentLoaded", function () {

    // ===== MENU MOBILE =====
    const toggle = document.querySelector(".menu-toggle");
    const mobileWrap = document.querySelector(".mobile-menu");
    const mobileLinks = document.querySelectorAll(".mobile-nav a");

    if (toggle && mobileWrap) {

        function openMenu() {
            toggle.classList.add("is-active");
            toggle.setAttribute("aria-expanded", "true");
            mobileWrap.classList.add("is-open");
            document.body.style.overflow = "hidden";
        }

        function closeMenu() {
            toggle.classList.remove("is-active");
            toggle.setAttribute("aria-expanded", "false");
            mobileWrap.classList.remove("is-open");
            document.body.style.overflow = "";
        }

        toggle.addEventListener("click", function () {
            mobileWrap.classList.contains("is-open") ? closeMenu() : openMenu();
        });

        mobileWrap.addEventListener("click", function (e) {
            if (e.target === mobileWrap) closeMenu();
        });

        mobileLinks.forEach(function (link) {
            link.addEventListener("click", closeMenu);
        });

        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape" && mobileWrap.classList.contains("is-open")) {
                closeMenu();
            }
        });
    }

    // ===== FAQ =====
    const items = document.querySelectorAll(".faq-brutal-item");

    items.forEach(function (item) {
        const button = item.querySelector(".faq-brutal-question");

        if (!button) return;

        button.addEventListener("click", function () {
            const isActive = item.classList.contains("active");

            items.forEach(function (otherItem) {
                otherItem.classList.remove("active");
                const otherButton = otherItem.querySelector(".faq-brutal-question");
                if (otherButton) {
                    otherButton.setAttribute("aria-expanded", "false");
                }
            });

            if (!isActive) {
                item.classList.add("active");
                button.setAttribute("aria-expanded", "true");
            }
        });
    });

    // ===== AUDIT MULTI-STEP FORM =====
    const multistepForm = document.querySelector("[data-multistep-form]");

    if (multistepForm) {
        const steps = Array.from(multistepForm.querySelectorAll("[data-step]"));
        const prevButton = multistepForm.querySelector("[data-prev-step]");
        const nextButton = multistepForm.querySelector("[data-next-step]");
        const submitButton = multistepForm.querySelector("[data-submit-step]");
        const progressLabel = multistepForm.querySelector("[data-progress-label]");
        const progressBar = multistepForm.querySelector("[data-progress-bar]");
        const reviewList = multistepForm.querySelector("[data-review-list]");
        let currentStep = 0;

        function stepFields(step) {
            return Array.from(step.querySelectorAll("input, select, textarea"));
        }

        function setStepFieldsState() {
            steps.forEach(function (step, index) {
                stepFields(step).forEach(function (field) {
                    field.disabled = index !== currentStep;
                });
            });
        }

        function updateReview() {
            if (!reviewList) return;

            const rows = [];
            const fields = Array.from(multistepForm.querySelectorAll("[data-summary]"));

            fields.forEach(function (field) {
                const label = field.getAttribute("data-summary");
                let value = field.value;

                if (field.tagName === "SELECT" && field.selectedOptions.length) {
                    value = field.selectedOptions[0].text;
                }

                if (value) {
                    rows.push({ label, value });
                }
            });

            const checkedChannels = Array.from(multistepForm.querySelectorAll('input[name="channels[]"]:checked'))
                .map(function (field) {
                    return field.value;
                });

            if (checkedChannels.length) {
                rows.push({ label: "Canali", value: checkedChannels.join(", ") });
            }

            reviewList.innerHTML = rows.length
                ? rows.map(function (row) {
                    return "<div><span>" + row.label + "</span><strong>" + row.value + "</strong></div>";
                }).join("")
                : "<p>Il riepilogo si aggiorna automaticamente mentre compili il form.</p>";
        }

        function renderStep() {
            steps.forEach(function (step, index) {
                step.classList.toggle("is-active", index === currentStep);
            });

            if (progressLabel) {
                progressLabel.textContent = "Step " + (currentStep + 1) + " di " + steps.length;
            }

            if (progressBar) {
                progressBar.style.width = (((currentStep + 1) / steps.length) * 100) + "%";
            }

            if (prevButton) {
                prevButton.style.visibility = currentStep === 0 ? "hidden" : "visible";
            }

            if (nextButton) {
                nextButton.style.display = currentStep === steps.length - 1 ? "none" : "inline-flex";
            }

            if (submitButton) {
                submitButton.style.display = currentStep === steps.length - 1 ? "inline-flex" : "none";
            }

            setStepFieldsState();
            updateReview();
        }

        function validateCurrentStep() {
            const fields = stepFields(steps[currentStep]);

            for (const field of fields) {
                if (!field.checkValidity()) {
                    field.reportValidity();
                    return false;
                }
            }

            return true;
        }

        if (nextButton) {
            nextButton.addEventListener("click", function () {
                if (!validateCurrentStep()) return;

                currentStep = Math.min(currentStep + 1, steps.length - 1);
                renderStep();
            });
        }

        if (prevButton) {
            prevButton.addEventListener("click", function () {
                currentStep = Math.max(currentStep - 1, 0);
                renderStep();
            });
        }

        multistepForm.addEventListener("input", updateReview);
        multistepForm.addEventListener("change", updateReview);

        multistepForm.addEventListener("submit", function (event) {
            if (!validateCurrentStep()) {
                event.preventDefault();
                return;
            }

            steps.forEach(function (step) {
                stepFields(step).forEach(function (field) {
                    field.disabled = false;
                });
            });
        });

        renderStep();
    }

});
