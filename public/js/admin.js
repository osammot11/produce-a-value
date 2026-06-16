document.addEventListener("DOMContentLoaded", function () {
    const quoteForm = document.querySelector("[data-admin-quote-form]");

    if (quoteForm) {
        const list = quoteForm.querySelector("[data-quote-items-list]");
        const template = quoteForm.querySelector("[data-quote-item-template]");
        const addButton = quoteForm.querySelector("[data-add-quote-item]");
        const richtextInput = quoteForm.querySelector("[data-richtext-input]");
        const richtextSource = quoteForm.querySelector("[data-richtext-source]");

        function itemRows() {
            return Array.from(quoteForm.querySelectorAll("[data-quote-item]"));
        }

        function reindexItems() {
            itemRows().forEach(function (row, index) {
                row.querySelectorAll("input, textarea").forEach(function (field) {
                    field.name = field.name.replace(/items\[\d+]/, "items[" + index + "]");
                });

                const removeButton = row.querySelector("[data-remove-quote-item]");
                if (removeButton) {
                    removeButton.disabled = itemRows().length === 1;
                }
            });
        }

        if (addButton && list && template) {
            addButton.addEventListener("click", function () {
                const index = itemRows().length;
                const html = template.innerHTML.replaceAll("__INDEX__", index);
                list.insertAdjacentHTML("beforeend", html);
                reindexItems();
            });
        }

        quoteForm.addEventListener("click", function (event) {
            const removeButton = event.target.closest("[data-remove-quote-item]");
            const commandButton = event.target.closest("[data-richtext-command]");
            const formatButton = event.target.closest("[data-richtext-format]");

            if (removeButton) {
                const row = removeButton.closest("[data-quote-item]");
                if (row && itemRows().length > 1) {
                    row.remove();
                    reindexItems();
                }
            }

            if (commandButton && richtextInput) {
                richtextInput.focus();
                document.execCommand(commandButton.getAttribute("data-richtext-command"), false, null);
            }

            if (formatButton && richtextInput) {
                richtextInput.focus();
                document.execCommand("formatBlock", false, formatButton.getAttribute("data-richtext-format"));
            }
        });

        quoteForm.addEventListener("submit", function () {
            if (richtextInput && richtextSource) {
                richtextSource.value = richtextInput.innerHTML.trim();
            }
        });

        reindexItems();
    }
});
