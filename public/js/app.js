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
    const items = document.querySelectorAll(".faq-item");

    items.forEach(function (item) {
        const button = item.querySelector(".faq-question");

        if (!button) return;

        button.addEventListener("click", function () {
            const isActive = item.classList.contains("active");

            items.forEach(function (otherItem) {
                otherItem.classList.remove("active");
                const otherButton = otherItem.querySelector(".faq-question");
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
        const countedSteps = steps.filter(function (step) {
            return !step.hasAttribute("data-loading-step");
        });
        let currentStep = 0;
        let loadingTimer = null;

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

        function renderStep() {
            if (loadingTimer) {
                window.clearTimeout(loadingTimer);
                loadingTimer = null;
            }

            steps.forEach(function (step, index) {
                step.classList.toggle("is-active", index === currentStep);
            });

            const currentStepElement = steps[currentStep];
            const isLoadingStep = currentStepElement.hasAttribute("data-loading-step");
            const progressStep = countedSteps.indexOf(currentStepElement) + 1;

            if (progressLabel) {
                progressLabel.textContent = isLoadingStep
                    ? "Elaborazione RADAR"
                    : "Step " + progressStep + " di " + countedSteps.length;
            }

            if (progressBar) {
                const progressWidth = isLoadingStep
                    ? ((countedSteps.length - 1) / countedSteps.length) * 100
                    : (progressStep / countedSteps.length) * 100;

                progressBar.style.width = progressWidth + "%";
            }

            if (prevButton) {
                prevButton.style.visibility = currentStep === 0 || isLoadingStep ? "hidden" : "visible";
            }

            if (nextButton) {
                nextButton.style.display = currentStep === steps.length - 1 || isLoadingStep ? "none" : "inline-flex";
            }

            if (submitButton) {
                submitButton.style.display = currentStep === steps.length - 1 ? "inline-flex" : "none";
            }

            setStepFieldsState();

            if (isLoadingStep) {
                loadingTimer = window.setTimeout(function () {
                    currentStep = Math.min(currentStep + 1, steps.length - 1);
                    renderStep();
                }, 1800);
            }
        }

        function validateCurrentStep() {
            const currentStepElement = steps[currentStep];
            const fields = stepFields(currentStepElement);

            const checkboxGroups = Array.from(currentStepElement.querySelectorAll("[data-required-checkbox-group]"));

            for (const group of checkboxGroups) {
                const hasCheckedOption = Boolean(group.querySelector('input[type="checkbox"]:checked'));

                if (!hasCheckedOption) {
                    const groupName = group.getAttribute("data-required-checkbox-group") || "opzione";
                    window.alert("Seleziona almeno una voce per: " + groupName + ".");
                    return false;
                }
            }

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

                if (steps[currentStep].hasAttribute("data-loading-step")) {
                    currentStep = Math.max(currentStep - 1, 0);
                }

                renderStep();
            });
        }

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
