import { Outlet } from "react-router-dom";
import Header from "../ui/Header";

export const MainLayout = () => {
  return (
    <div className="max-w-[2200px] w-full h-screen flex justify-start items-center mt-10 flex-col">
      <header className="w-full flex justify-center items-center">
        <Header />
      </header>
      <main className="w-full flex justify-center items-center">
        <Outlet />
      </main>
    </div>
  );
};
