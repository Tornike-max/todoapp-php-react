import { createContext, useEffect, useState } from "react";
import { useMutation, useQueryClient } from "@tanstack/react-query";
import { loginUserApi } from "../api/api";
import { LoginType } from "../types/types";
import toast from "react-hot-toast";

interface User {
  users_id: string;
  firstname: string;
  lastname: string;
  email: string;
}

interface AuthContextType {
  loginUser: (data: LoginType) => void;
  authUser: User | null;
  isLogingIn: boolean;
}

export const AuthProvider = createContext<AuthContextType>({
  loginUser: () => {},
  authUser: null,
  isLogingIn: false,
});

const AuthContext = ({ children }: { children: React.ReactNode }) => {
  const [authUser, setAuthUser] = useState<User | null>(null);
  const queryClient = useQueryClient();

  useEffect(() => {
    if (localStorage.getItem("authUser")) {
      const getResponse = localStorage.getItem("authUser");
      setAuthUser(JSON.parse(getResponse || ""));
    }
  }, []);

  const { mutate: loginUser, isPending: isLogingIn } = useMutation({
    mutationFn: (data: LoginType) => loginUserApi(data),
    onSuccess: (data) => {
      const user = data.response;
      localStorage.setItem("authUser", JSON.stringify(user));
      setAuthUser(user);
      toast.success("User Registered Successfully");
      queryClient.invalidateQueries({ queryKey: ["users"] });
    },
    onError: () => {
      toast.error("Error while Registering");
    },
  });

  const value = {
    loginUser,
    isLogingIn,
    authUser,
  };

  return (
    <AuthProvider.Provider value={value}>{children}</AuthProvider.Provider>
  );
};

export default AuthContext;
