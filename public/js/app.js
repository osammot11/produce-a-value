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

    // ===== CUSTOM CAL.COM BOOKING =====
    const calBooking = document.querySelector("[data-cal-booking]");

    if (calBooking) {
        const slotsUrl = calBooking.getAttribute("data-slots-url");
        const bookUrl = calBooking.getAttribute("data-book-url");
        const thanksUrl = calBooking.getAttribute("data-thanks-url");
        const timeZone = calBooking.getAttribute("data-timezone") || "Europe/Rome";
        const bookingSteps = Array.from(calBooking.querySelectorAll("[data-cal-booking-step]"));
        const progressSteps = Array.from(calBooking.querySelectorAll("[data-cal-progress-step]"));
        const status = calBooking.querySelector("[data-cal-status]");
        const selectedDayText = calBooking.querySelector("[data-cal-selected-day]");
        const selectedSlotText = calBooking.querySelector("[data-cal-selected-slot]");
        const daysWrap = calBooking.querySelector("[data-cal-days]");
        const slotsWrap = calBooking.querySelector("[data-cal-slots]");
        const form = calBooking.querySelector("[data-cal-form]");
        const startInput = calBooking.querySelector("[data-cal-start]");
        const submitButton = calBooking.querySelector("[data-cal-submit]");
        const message = calBooking.querySelector("[data-cal-message]");
        const loader = calBooking.querySelector("[data-cal-loader]");
        let groupedSlots = {};
        let currentBookingStep = 0;
        let selectedDayKey = null;
        let isBookingSubmitting = false;

        function csrfToken() {
            const tag = document.querySelector('meta[name="csrf-token"]');
            return tag ? tag.getAttribute("content") : "";
        }

        function renderBookingStep() {
            bookingSteps.forEach(function (step, index) {
                step.classList.toggle("is-active", index === currentBookingStep);
            });

            progressSteps.forEach(function (step, index) {
                step.classList.toggle("is-active", index === currentBookingStep);
            });
        }

        function setStatus(text) {
            if (status) status.textContent = text;
        }

        function setMessage(text, isError) {
            if (!message) return;
            message.textContent = text;
            message.classList.toggle("is-error", Boolean(isError));
        }

        function setFormLocked(locked) {
            isBookingSubmitting = locked;
            form.classList.toggle("is-submitting", locked);
            form.setAttribute("aria-busy", locked ? "true" : "false");

            if (loader) {
                loader.setAttribute("aria-hidden", locked ? "false" : "true");
            }

            Array.from(form.querySelectorAll("input, textarea, button")).forEach(function (field) {
                if (field === submitButton) {
                    field.disabled = locked || !startInput.value;
                    return;
                }

                field.disabled = locked;
            });
        }

        function formatDay(dateKey) {
            return new Intl.DateTimeFormat("it-IT", {
                weekday: "short",
                day: "2-digit",
                month: "short",
                timeZone: timeZone,
            }).format(new Date(dateKey + "T12:00:00"));
        }

        function formatTime(value) {
            return new Intl.DateTimeFormat("it-IT", {
                hour: "2-digit",
                minute: "2-digit",
                timeZone: timeZone,
            }).format(new Date(value));
        }

        function normalizeSlots(slots) {
            const normalized = {};

            Object.keys(slots || {}).forEach(function (dateKey) {
                normalized[dateKey] = (slots[dateKey] || []).map(function (slot) {
                    return {
                        start: typeof slot === "string" ? slot : slot.start,
                        end: typeof slot === "string" ? null : slot.end,
                    };
                }).filter(function (slot) {
                    return Boolean(slot.start);
                });
            });

            return normalized;
        }

        function selectSlot(button, slot) {
            calBooking.querySelectorAll(".cal-slot").forEach(function (slotButton) {
                slotButton.classList.remove("is-active");
            });

            button.classList.add("is-active");
            startInput.value = slot.start;
            submitButton.disabled = false;
            if (selectedSlotText) {
                selectedSlotText.textContent = "Slot selezionato: " + formatDay(selectedDayKey) + " alle " + formatTime(slot.start) + ".";
            }
            setMessage("Slot selezionato: " + formatTime(slot.start) + ".", false);
            currentBookingStep = 2;
            renderBookingStep();
        }

        function renderSlots(dateKey) {
            slotsWrap.innerHTML = "";
            startInput.value = "";
            submitButton.disabled = true;
            setMessage("", false);

            if (selectedDayText) {
                selectedDayText.textContent = "Giorno selezionato: " + formatDay(dateKey) + ".";
            }

            (groupedSlots[dateKey] || []).forEach(function (slot) {
                const button = document.createElement("button");
                button.type = "button";
                button.className = "cal-slot";
                button.textContent = slot.end
                    ? formatTime(slot.start) + " - " + formatTime(slot.end)
                    : formatTime(slot.start);
                button.addEventListener("click", function () {
                    selectSlot(button, slot);
                });
                slotsWrap.appendChild(button);
            });
        }

        function renderDays() {
            const dateKeys = Object.keys(groupedSlots).filter(function (dateKey) {
                return groupedSlots[dateKey].length > 0;
            });

            daysWrap.innerHTML = "";
            slotsWrap.innerHTML = "";
            selectedDayKey = null;

            if (!dateKeys.length) {
                setStatus("Non ci sono slot disponibili nei prossimi giorni. Riprova più tardi.");
                return;
            }

            setStatus("Scegli il giorno da cui partire.");

            dateKeys.forEach(function (dateKey) {
                const button = document.createElement("button");
                button.type = "button";
                button.className = "cal-day";
                button.textContent = formatDay(dateKey);
                button.addEventListener("click", function () {
                    calBooking.querySelectorAll(".cal-day").forEach(function (dayButton) {
                        dayButton.classList.remove("is-active");
                    });
                    button.classList.add("is-active");
                    selectedDayKey = dateKey;
                    renderSlots(dateKey);
                    currentBookingStep = 1;
                    renderBookingStep();
                });
                daysWrap.appendChild(button);
            });
        }

        async function loadSlots() {
            try {
                setStatus("Caricamento slot disponibili...");
                const response = await fetch(slotsUrl + "?timeZone=" + encodeURIComponent(timeZone), {
                    headers: {
                        "Accept": "application/json",
                    },
                });
                const payload = await response.json();

                if (!response.ok) {
                    throw new Error(payload.message || "Slot non disponibili.");
                }

                groupedSlots = normalizeSlots(payload.slots);
                renderDays();
            } catch (error) {
                setStatus(error.message || "Non siamo riusciti a leggere gli slot disponibili.");
            }
        }

        if (form) {
            calBooking.querySelectorAll("[data-cal-back]").forEach(function (button) {
                button.addEventListener("click", function () {
                    currentBookingStep = Math.max(0, currentBookingStep - 1);
                    renderBookingStep();
                });
            });

            form.addEventListener("submit", async function (event) {
                event.preventDefault();

                if (isBookingSubmitting) return;

                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                const data = new FormData(form);
                data.append("timeZone", timeZone);
                setFormLocked(true);
                setMessage("Prenotazione in corso. Non chiudere questa pagina.", false);

                try {
                    const response = await fetch(bookUrl, {
                        method: "POST",
                        headers: {
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": csrfToken(),
                        },
                        body: data,
                    });
                    const payload = await response.json();

                    if (!response.ok) {
                        throw new Error(payload.message || "Prenotazione non riuscita.");
                    }

                    setMessage("Call prenotata. Controlla la tua email per conferma e link.", false);
                    form.classList.add("is-booked");
                    if (thanksUrl) {
                        window.location.href = thanksUrl;
                    }
                } catch (error) {
                    setFormLocked(false);
                    setMessage(error.message || "Non siamo riusciti a creare la prenotazione.", true);
                }
            });
        }

        renderBookingStep();
        loadSlots();
    }

});
