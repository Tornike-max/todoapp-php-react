import { BrowserRouter, Route, Routes } from "react-router-dom";
import { MainLayout } from "./layout/MainLayout";
import LoginPage from "./pages/LoginPage";
import RegisterPage from "./pages/RegisterPage";
import Main from "./pages/Main";
import ProtectedRoute from "./ui/ProtectedRoute";
import NotFoundPage from "./pages/NotFoundPage";

const App = () => {
  return (
    <div className="max-w-[2200px] w-full flex justify-center">
      <BrowserRouter>
        <Routes>
          <Route element={<MainLayout />}>
            <Route
              index
              element={
                // <ProtectedRoute>
                <Main />
                // </ProtectedRoute>
              }
            />

            <Route path="/login" element={<LoginPage />} />
            <Route path="/register" element={<RegisterPage />} />
            <Route path="*" element={<NotFoundPage />} />
          </Route>
        </Routes>
      </BrowserRouter>
    </div>
  );
};

export default App;
