import React from "react";
import ReactDOM from "react-dom/client";
import App from "./components/App";

ReactDOM.createRoot(document.getElementById("root")!).render(
  <React.StrictMode>
    <App text="Hello there" />
  </React.StrictMode>
);
