import { createContext } from "react";
import { useGetAuthUser } from "../hooks/useGetAuthUser";

interface User {
  id: number;
  firstname: string;
  lastname: string;
  email: string;
}

interface AuthContextType {
  authUser: User | null;
  isUserPending: boolean;
}

export const AuthProvider = createContext<AuthContextType>({
  authUser: null,
  isUserPending: false,
});

const AuthContext = ({ children }: { children: React.ReactNode }) => {
  const { authUser, isUserPending } = useGetAuthUser();

  if (isUserPending) return null;

  const value = {
    authUser,
    isUserPending,
  };

  return (
    <AuthProvider.Provider value={value}>{children}</AuthProvider.Provider>
  );
};

export default AuthContext;
