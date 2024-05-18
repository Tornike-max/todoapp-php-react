import { useContext } from "react";
import { AuthProvider } from "./AuthContext";

export const useAuth = () => {
  const context = useContext(AuthProvider);

  if (context === undefined) {
    throw new Error("You are using authcontext outside of the main context");
  }

  return context;
};
