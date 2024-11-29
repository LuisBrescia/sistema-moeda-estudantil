import { definePreset } from '@primevue/themes';
import Aura from '@primevue/themes/aura';
import Lara from '@primevue/themes/lara';
import Nora from '@primevue/themes/nora';

const Brescia = definePreset(Aura, {
  semantic: {
    primary: {
      50: '{orange.50}',
      100: '{orange.100}',
      200: '{orange.200}',
      300: '{orange.300}',
      400: '{orange.400}',
      500: '{orange.500}',
      600: '{orange.600}',
      700: '{orange.700}',
      800: '{orange.800}',
      900: '{orange.900}',
      950: '{orange.950}',
    },
    colorScheme: {
      light: {
        surface: {
          0: '#ffffff',
          50: '{slate.50}',
          100: '{slate.100}',
          200: '{slate.200}',
          300: '{slate.300}',
          400: '{slate.400}',
          500: '{slate.500}',
          600: '{slate.600}',
          700: '{slate.700}',
          800: '{slate.800}',
          900: '{slate.900}',
        },
      },
      dark: {
        formField: {
          background: '#020617',
        },
        surface: {
          0: '#ffffff',
          50: '{slate.50}',
          100: '{slate.100}',
          200: '{slate.200}',
          300: '{slate.300}',
          400: '{slate.400}',
          500: '{slate.500}',
          600: '{slate.600}',
          700: '{slate.700}',
          800: '{slate.800}',
          900: '{slate.900}',
        },
      },
    },
  },
  components: {
    avatar: {
      width: '1.5rem',
      height: '1.5rem',
      fontSize: '0.75rem',
      lg: {
        width: '2rem',
        height: '2rem',
        fontSize: '1rem',
      },
      xl: {
        width: '3rem',
        height: '3rem',
        fontSize: '1.5rem',
      },
    },
  },
});

export default {
  preset: Brescia,
  options: {
    darkModeSelector: '.dark',
  },
};
