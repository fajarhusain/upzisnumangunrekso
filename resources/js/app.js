import "./bootstrap";

import Alpine from "alpinejs";

import Autosize from '@marcreichel/alpine-autosize';

Alpine.plugin(Autosize);

window.Alpine = Alpine;

Alpine.start();
