import { useMutation, useQueryClient } from "@tanstack/react-query";
import toast from "react-hot-toast";
import { LoginType } from "../types/types";
import { loginUserApi } from "../api/api";

export const useLogin = () => {
  const queryClient = useQueryClient();

  const { mutate: loginUser, isPending: isLogingIn } = useMutation({
    mutationFn: (data: LoginType) => loginUserApi(data),
    onSuccess: () => {
      toast.success("User Registered Successfully");
      queryClient.invalidateQueries({ queryKey: ["users"] });
    },
    onError: () => {
      toast.error("Error while Registering");
    },
  });
  return { loginUser, isLogingIn };
};
