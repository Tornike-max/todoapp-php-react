import { BrowserRouter, Route, Routes } from "react-router-dom";
import Main from "./components/Main";
import { MainLayout } from "./layout/MainLayout";
import Edit from "./components/Edit";

const App = () => {
  return (
    <div className="max-w-[2200px] w-full flex justify-center">
      <BrowserRouter>
        <Routes>
          <Route element={<MainLayout />}>
            <Route index element={<Main />} />
            <Route path="/edit/:editId" element={<Edit />} />
          </Route>
        </Routes>
      </BrowserRouter>
    </div>
  );
};

export default App;
