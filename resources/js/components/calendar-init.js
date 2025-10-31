import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import interactionPlugin from "@fullcalendar/interaction";
import idLocale from "@fullcalendar/core/locales/id";

document.addEventListener("DOMContentLoaded", function () {
    const calendarEl = document.querySelector("#calendar");
    if (!calendarEl) return;

    /* ======================
       Inisialisasi Kalender
    ====================== */
    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        locale: idLocale,
        // eventOrder: "id",
        // eventOrder: ["start", "createdAt"],
        eventOrder: function (a, b) {
            // Urutkan berdasarkan createdAt, bukan tanggal start
            return a.extendedProps.createdAt - b.extendedProps.createdAt;
        },
        eventOrderStrict: true,

        headerToolbar: {
            left: "prev,next today addEventButton",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay",
        },
        events: "/activities/events",

        eventDidMount: function (info) {
            const titleEl = info.el.querySelector(".fc-event-title");
            if (!titleEl) return;

            const containerWidth = titleEl.parentElement.clientWidth;
            const textWidth = titleEl.scrollWidth;

            // hanya jalankan animasi jika teks lebih panjang dari wadah
            if (textWidth <= containerWidth) {
                titleEl.style.whiteSpace = "nowrap";
                return;
            }

            const text = titleEl.textContent.trim();

            const wrapper = document.createElement("div");
            wrapper.className = "marquee-wrapper";

            const content = document.createElement("div");
            content.className = "marquee-content";

            const span1 = document.createElement("span");
            span1.className = "marquee-text";
            span1.textContent = text;

            const span2 = document.createElement("span");
            span2.className = "marquee-text";
            span2.textContent = text;

            content.appendChild(span1);
            content.appendChild(span2);
            wrapper.appendChild(content);

            titleEl.parentNode.replaceChild(wrapper, titleEl);

            // hitung panjang teks
            const spanWidth = span1.getBoundingClientRect().width;
            const gap = 32; // sesuai padding-right di CSS (2rem)
            const distance = spanWidth + gap;

            // durasi berdasarkan panjang teks
            const speed = 20; // px per detik
            const duration = distance / speed + "s";

            // set CSS variable untuk animasi
            content.style.setProperty("--marquee-distance", `-${distance}px`);
            content.style.setProperty("--marquee-duration", duration);

            // mulai animasi
            content.classList.add("animate");
        },

        customButtons: {
            addEventButton: {
                text: "Tambah Kegiatan +",
                click: function () {
                    const modal = document.querySelector(
                        "#hs-scale-animation-modal"
                    );
                    if (modal) {
                        window.HSOverlay.open(modal);
                    } else {
                        console.error("Modal tidak ditemukan!");
                    }
                },
            },
        },

        // Klik tanggal untuk tambah event
        dateClick: function (info) {
            const modal = document.querySelector("#hs-scale-animation-modal");
            if (modal) {
                window.HSOverlay.open(modal);
                const startDateInput = modal.querySelector(
                    'input[name="start_date"]'
                );
                if (startDateInput) startDateInput.value = info.dateStr;
            } else {
                console.error("Modal tidak ditemukan!");
            }
        },

        // Klik event untuk edit
        eventClick: function (info) {
            const event = info.event.extendedProps;
            openModal("editEventModal");

            // 🔹 Set action form ke URL update sesuai ID
            const form = document.querySelector("#editEventForm");
            if (form) {
                form.action = `/activities/${info.event.id}`;
            }

            // isi input lain
            document.querySelector("#edit-id").value = info.event.id;
            document.querySelector("#edit-title").value = info.event.title;
            document.querySelector("#edit-type").value = event.activity_type;
            document.querySelector("#edit-location").value =
                event.location || "";
            document.querySelector("#edit-start").value =
                info.event.startStr.split("T")[0];
            document.querySelector("#edit-end").value = info.event.endStr
                ? info.event.endStr.split("T")[0]
                : info.event.startStr.split("T")[0];
            document.querySelector("#edit-description").value =
                event.description || "";

            // 🔥 Reset semua radio color dulu
            document
                .querySelectorAll('#editEventModal input[name="color"]')
                .forEach((radio) => {
                    radio.checked = false;
                });

            // 🔥 Lalu pilih warna sesuai database
            if (event.color) {
                const selectedColor = document.querySelector(
                    `#editEventModal input[name="color"][value="${event.color}"]`
                );
                if (selectedColor) {
                    selectedColor.checked = true;
                } else {
                    console.warn(
                        `Warna ${event.color} tidak ditemukan di radio`
                    );
                }
            } else {
                console.warn("Tidak ada color di data event");
            }
        },
    });

    calendar.render();

    /* ======================
       Ambil Elemen Modal
    ====================== */
    const getModalTitleEl = document.querySelector("#event-title");
    const getModalEventTypeEl = document.querySelector("#event-type");
    const getModalLocationEl = document.querySelector("#event-location");
    const getModalColorEl = () =>
        document.querySelector('input[name="color"]:checked');
    const getModalStartDateEl = document.querySelector("#event-start-date");
    const getModalEndDateEl = document.querySelector("#event-end-date");
    const getModalDescriptionEl = document.querySelector("#event-description");
    const getModalAddBtnEl = document.querySelector(".btn-add-event");
    const getModalUpdateBtnEl = document.querySelector(".btn-update-event");

    /* ======================
       Fungsi Modal
    ====================== */
    function openModal(id) {
        const modal = document.getElementById(id);
        if (modal) modal.classList.remove("hidden");
    }

    function closeModals() {
        document.querySelectorAll(".modal").forEach((m) => {
            m.classList.add("hidden");
        });
    }

    document
        .querySelectorAll(".modal-close, .btn-cancel, .modal-overlay")
        .forEach((btn) => btn.addEventListener("click", closeModals));

    /* ======================
       Submit Tambah/Edit Event
    ====================== */
    if (getModalAddBtnEl) {
        getModalAddBtnEl.addEventListener("click", async (e) => {
            e.preventDefault();

            const colorInput = getModalColorEl();
            const data = {
                title: getModalTitleEl.value,
                activity_type: getModalEventTypeEl.value,
                location: getModalLocationEl.value,
                color: colorInput ? colorInput.value : "primary",
                start_date: getModalStartDateEl.value,
                end_date: getModalEndDateEl.value,
                description: getModalDescriptionEl.value,
            };

            await fetch("/activities/store", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify(data),
            });

            closeModals();
            calendar.refetchEvents();
        });
    }

    if (getModalUpdateBtnEl) {
        getModalUpdateBtnEl.addEventListener("click", async (e) => {
            e.preventDefault();

            const id = document.querySelector("#edit-id").value;
            const colorInput = document.querySelector(
                '#editEventModal input[name="color"]:checked'
            );

            const data = {
                title: document.querySelector("#edit-title").value,
                activity_type: document.querySelector("#edit-type").value,
                location: document.querySelector("#edit-location").value,
                color: colorInput ? colorInput.value : "primary",
                start_date: document.querySelector("#edit-start").value,
                end_date: document.querySelector("#edit-end").value,
                description: document.querySelector("#edit-description").value,
            };

            await fetch(`/activities/update/${id}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify(data),
            });

            closeModals();
            calendar.refetchEvents();
        });
    }
});
