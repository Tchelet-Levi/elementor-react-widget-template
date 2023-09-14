import { defineConfig } from "vite";
import { resolve } from "path";
import react from "@vitejs/plugin-react";
import externalGlobals from "rollup-plugin-external-globals";

//@ts-ignore
export default defineConfig(({ command }) => {
  // vite dev
  if (command === "serve") {
    return {
      plugins: [react()],
    };
  } else {
    // vite build
    return {
      plugins: [react({ jsxRuntime: "classic" })],
      build: {
        lib: {
          entry: resolve(__dirname, "lib/index.tsx"),
          name: "ElementorReactApplication",
          formats: ["es"],
          fileName: () => `index.js`,
        },
        outDir: "../assets/",
        rollupOptions: {
          plugins: [
            externalGlobals({
              react: "React",
              "react-dom": "ReactDOM",
            }),
          ],
          external: ["react", "react/jsx-runtime", "react-dom"],
        },
      },
    };
  }
});
