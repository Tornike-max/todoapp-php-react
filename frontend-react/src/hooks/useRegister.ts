import { useMutation, useQueryClient } from "@tanstack/react-query";
import { RegisterType } from "../types/types";
import toast from "react-hot-toast";
import { registerApi } from "../api/api";

export const useRegister = () => {
  const queryClient = useQueryClient();

  const { mutate: registerUser, isPending: isRegistering } = useMutation({
    mutationFn: (data: RegisterType) => registerApi(data),
    onSuccess: () => {
      toast.success("User Registered Successfully");
      queryClient.invalidateQueries({ queryKey: ["users"] });
    },
    onError: () => {
      toast.error("Error while Registering");
    },
  });
  return { registerUser, isRegistering };
};
