import "./bootstrap";
import "../css/style.css";

import "../css/style.css";

import "preline";

import Alpine from "alpinejs";
import persist from "@alpinejs/persist";

Alpine.plugin(persist);

window.Alpine = Alpine;

Alpine.start();
