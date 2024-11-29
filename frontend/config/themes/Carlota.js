import { definePreset } from '@primevue/themes';
import Lara from '@primevue/themes/lara';

const Carlota = definePreset(Lara, {
  primitive: {
    borderRadius: {
      none: '0',
      xs: '2px',
      sm: '4px',
      md: '8px',
      lg: '12px',
      xl: '16px',
    },
  },
  semantic: {
    formField: {
      paddingX: '0.75rem',
      paddingY: '0.5rem',
      borderRadius: '{border.radius.sm}',
      focusRing: {
        width: '2px',
        style: 'solid',
        color: '{primary.color}',
        offset: '-1px',
        shadow: 'none',
      },
      transitionDuration: '{transition.duration}',
    },
    transitionDuration: '0s',
    primary: {
      50: '#fff3e0',
      100: '#ffe0b2',
      200: '#ffcc80',
      300: '#ffb74d',
      400: '#ffa726',
      500: '#ff9800',
      600: '#fb8c00',
      700: '#f57c00',
      800: '#ef6c00',
      900: '#e65100',
      950: '#bf360c',
    },
    colorScheme: {
      light: {
        surface: {
          0: '#ffffff',
          50: '#fff3e0',
          100: '#ffe0b2',
          200: '#ffcc80',
          300: '#ffb74d',
          400: '#ffa726',
          500: '#ff9800',
          600: '#fb8c00',
          700: '#f57c00',
          800: '#ef6c00',
          900: '#e65100',
        },
      },
      dark: {
        content: {
          background: '#424242',
        },
        surface: {
          0: '#ffffff',
          50: '#fff3e0',
          100: '#ffe0b2',
          200: '#ffcc80',
          300: '#ffb74d',
          400: '#ffa726',
          500: '#ff9800',
          600: '#fb8c00',
          700: '#f57c00',
          800: '#ef6c00',
          900: '#e65100',
        },
      },
    },
  },
  components: {
    button: {
      colorScheme: {
        light: {
          root: {
            orange: {
              background: '#ff9800',
              hoverBackground: '#fb8c00',
              activeBackground: '#f57c00',
              borderColor: '#ff9800',
              hoverBorderColor: '#fb8c00',
              activeBorderColor: '#f57c00',
              color: '#ffffff',
              hoverColor: '#ffffff',
              activeColor: '#ffffff',
              focusRing: {
                color: '#fb8c00',
                shadow: 'none',
              },
            },
          },
          outlined: {
            secondary: {
              color: '#424242',
            },
          },
          text: {
            secondary: {
              hoverBackground: '#ffcc80',
              activeBackground: '#ffe0b2',
              color: '#424242',
            },
          },
        },
        dark: {
          orange: {
            background: '#ff9800',
            hoverBackground: '#fb8c00',
            activeBackground: '#f57c00',
            borderColor: '#ff9800',
            hoverBorderColor: '#fb8c00',
            activeBorderColor: '#f57c00',
            color: '#ffffff',
            hoverColor: '#ffffff',
            activeColor: '#ffffff',
            focusRing: {
              color: '#fb8c00',
              shadow: 'none',
            },
          },
          outlined: {
            secondary: {
              color: '#ffffff',
            },
          },
          text: {
            secondary: {
              color: '#ffffff',
            },
          },
        },
      },
    },
    checkbox: {
      root: {
        borderRadius: '4px',
      },
    },
  },
});

export default {
  preset: Carlota,
  options: {
    darkModeSelector: '.dark',
  },
};
