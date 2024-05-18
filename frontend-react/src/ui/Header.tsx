import { Button } from "@nextui-org/button";
import { useLocation, useNavigate } from "react-router-dom";

const Header = () => {
  const { pathname } = useLocation();
  const navigate = useNavigate();

  return (
    <div className="w-full flex justify-between items-center bg-slate-200 mx-10 px-10 py-6 rounded-3xl">
      <Button
        onClick={() => navigate("/")}
        variant="ghost"
        color="primary"
        className="font-semibold text-3xl"
        size="lg"
        disabled={pathname === "/"}
      >
        ToDo App
      </Button>
      <Button
        onClick={() => navigate("/second")}
        variant="ghost"
        color="primary"
        className="font-semibold text-3xl"
        size="lg"
      >
        second
      </Button>
      <div className="flex items-center gap-4">
        <Button
          onClick={() => navigate("/login")}
          variant="ghost"
          color="success"
          disabled={pathname === "/login"}
        >
          Login
        </Button>
        <Button
          onClick={() => navigate("/register")}
          variant="ghost"
          color="primary"
          disabled={pathname === "/register"}
        >
          Register
        </Button>
        <Button variant="ghost" color="danger">
          Logout
        </Button>
      </div>
    </div>
  );
};

export default Header;
