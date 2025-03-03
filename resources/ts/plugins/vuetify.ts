/**
 * plugins/vuetify.ts
 *
 * Framework documentation: https://vuetifyjs.com`
 */

// Styles
import "@mdi/font/css/materialdesignicons.css";
import "vuetify/styles";

// Composables
import { createVuetify } from "vuetify";

// https://vuetifyjs.com/en/introduction/why-vuetify/#feature-guides
export default createVuetify({
    display: {
        mobileBreakpoint: "sm",
        thresholds: {
            xs: 0,
            sm: 300,
            md: 599,
            lg: 750,
            xl: 1080,
        },
    },
    theme: {
        defaultTheme: "dark",
    },
});
