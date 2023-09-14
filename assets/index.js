const n = "_card_1hv9i_1", l = {
  card: n
};
function r({ text: e }) {
  const [t, c] = React.useState(0);
  return /* @__PURE__ */ React.createElement("div", { className: l.card }, /* @__PURE__ */ React.createElement("p", null, "Hi! I was rendered in React! :)"), /* @__PURE__ */ React.createElement("p", null, "Special text: ", e), /* @__PURE__ */ React.createElement("button", { onClick: () => c((a) => a + 1) }, "count is ", t));
}
export {
  r as default
};
