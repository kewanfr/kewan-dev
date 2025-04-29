function Maintenance() {

  return (
    <>
      <div className="flex flex-col items-center justify-center h-screen bg-gray-100">
        <div className="bg-white shadow-md rounded-lg p-6 max-w-md w-full">
          <h1 className="text-2xl font-bold mb-4">
            Site en cours développement
          </h1>
          <p className="text-gray-700 mb-4">
            Mon site{" "}
            <a href="https://kewan.dev" className="text-blue-500">
              kewan.dev
            </a>{" "}
            est actuellement en cours de développement. <br />
            Vous pouvez cependant vous rendre sur mon portfolio actuel ici: <br /><br />
            <a href="https://kewan.fr" className="text-blue-500">
              {" "}
              kewan.fr
            </a>
          </p>
          {/* <p className="text-gray-500">Merci de votre compréhension.</p> */}
        </div>
        <footer className="mt-6 text-gray-500">
          {/* <p>© 2023 Mon Application</p>
          <p>Tous droits réservés.</p> */}
        </footer>
      </div>
    </>
  );
}

export default Maintenance;
