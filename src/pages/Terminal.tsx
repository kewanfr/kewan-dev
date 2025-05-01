import React, { useState, useRef, useEffect } from "react";
import "./Terminal.css";

// Ton ASCII art, échappé pour template literal
const LOGO = `
  _  __ __                       ____                  _           
 | |/ //_/__      ____ _ _ __   | __ )  ___ _ __ _ __ (_) ___ _ __ 
 | ' // _ \\ \\ /\\ / / _\` | '_ \\  |  _ \\ / _ \\ '__| '_ \\| |/ _ \\ '__|
 | . \\  __/\\ V  V / (_| | | | | | |_) |  __/ |  | | | | |  __/ |   
 |_|\\_\\___| \\_/\\_/ \\__,_|_| |_| |____/ \\___|_|  |_| |_|_|\\___|_|   
                                                                    
`.trim();

type Line = React.ReactNode;

export const Terminal: React.FC = () => {
  const [lines, setLines] = useState<Line[]>([]);
  const [input, setInput] = useState("");
  const inputRef = useRef<HTMLInputElement>(null);

  // dès qu'on ajoute une ligne on remet le focus
  useEffect(() => {
    inputRef.current?.focus();
  }, [lines]);

  const append = (ln: Line) => setLines((prev) => [...prev, ln]);

  const runCommand = (raw: string) => {
    const cmd = raw.trim().toLowerCase();
    switch (cmd) {
      case "clear":
        return setLines([]);
      case "help":
        return append(
          <div>
            Available commands: <code>help</code>, <code>about</code>,{" "}
            <code>clear</code>
          </div>
        );
      case "about":
        return append(
          <div>This is my terminal-style portfolio, made in React+TSX.</div>
        );
      default:
        return append(
          <div>
            Command not found: <strong>{raw}</strong>
          </div>
        );
    }
  };

  const onSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!input.trim()) {
      setInput("");
      return;
    }
    // on “commite” la ligne de commande en lecture seule
    append(
      <div className="terminal-line">
        <span className="prompt">$</span> {input}
      </div>
    );
    runCommand(input);
    setInput("");
  };

  return (
    <div className="terminal-container">
      {/* Logo ASCII */}
      <pre className="logo">{"  "}{LOGO}</pre>

      {/* Buffer des lignes commitées */}
      <div className="terminal-buffer">
        {lines.map((ln, i) => (
          <div key={i} className="terminal-line">
            {ln}
          </div>
        ))}

        {/* Prompt actif */}
        <form onSubmit={onSubmit} className="terminal-prompt">
          <span className="prompt">$</span>
          <input
            ref={inputRef}
            className="prompt-input"
            value={input}
            onChange={(e) => setInput(e.target.value)}
            autoComplete="off"
          />
        </form>
      </div>

      {/* Boutons cliquables */}
      <div className="terminal-buttons">
        {["about", "help", "clear"].map((cmd) => (
          <button
            key={cmd}
            className="terminal-btn"
            onClick={() => {
              // simule la saisie + exécution
              append(
                <div className="terminal-line">
                  <span className="prompt">$</span> {cmd}
                </div>
              );
              runCommand(cmd);
            }}
          >
            {cmd.toUpperCase()}
          </button>
        ))}
      </div>
    </div>
  );
};

export default Terminal;
