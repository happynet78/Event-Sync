import './bootstrap';
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm.js';
import humanDate from "../../vendor/matildevoldsen/wire-comments/resources/js/directives/humanDate.js";

Alpine.directive('humanDate', humanDate);

Livewire.start();

// window.Alpine = Alpine;

// Alpine.start();
