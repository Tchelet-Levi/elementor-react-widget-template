import { useState } from "react";
import style from "./App.module.css";

type Props = {
  text: string;
};

function App({ text }: Props) {
  const [count, setCount] = useState(0);
  return (
    <div className={style.card}>
      <p>
        Welcome to <span className={style.react}>React</span> based widgets for Elementor!
      </p>

      <p>
        Example Control: <span className={style.exampleControl}>{text}</span>
      </p>

      <p>vvvv Style inherinted from Elementor vvv</p>
      <button onClick={() => setCount((p) => p + 1)}>Count: {count}</button>
    </div>
  );
}

export default App;
