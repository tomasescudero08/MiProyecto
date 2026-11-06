import * as Sentry from "@sentry/react"; // O el paquete de Sentry que hayas instalado

Sentry.init({
    dsn: "https://43093452697012d8ff1ca553406d788d@o4512370815664128.ingest.us.sentry.io/4512381760897024",
    tracesSampleRate: 1.0,
});

import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
