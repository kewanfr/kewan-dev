function Home() {

  

  return (
    <>
      <div className="terminal">
        <div className="terminal-header">
          <div className="terminal-header-buttons">
            <div className="button red"></div>
            <div className="button yellow"></div>
            <div className="button green"></div>
          </div>
          <div className="terminal-header-title">Terminal</div>
        </div>
        <div className="terminal-content">
          <p>Bienvenue dans le terminal !</p>
          <p>Vous pouvez exécuter des commandes ici.</p>
          <p>
            Essayez de taper <code>help</code> pour voir la liste des commandes
            disponibles.
          </p>
          <p>
            Ou tapez <code>clear</code> pour effacer l'écran.
          </p>
          <p>
            Ou tapez <code>exit</code> pour quitter le terminal.
          </p>
        </div>
        <div className="terminal-input">
          <span className="prompt">user@terminal:~$</span>
          <input type="text" className="input" />
        </div>
        <div className="terminal-footer">
          <p>Terminal v1.0</p>
          <p>© 2023 Mon Application</p>
        </div>
      </div>
    </>
  );
}

export default Home;
