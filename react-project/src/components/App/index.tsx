import { useState } from "react";
import style from "./App.module.css";

type Props = {
  text: string;
};

function App({ text }: Props) {
  const [count, setCount] = useState(0);
  return (
    <div className={style.card}>
      <p>Hi! I was rendered in React! :)</p>
      <p>Special text: {text}</p>
      <button onClick={() => setCount((count) => count + 1)}>count is {count}</button>
    </div>
  );
}

export default App;
