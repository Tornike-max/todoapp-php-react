import { useMutation, useQueryClient } from "@tanstack/react-query";
import { TodoType } from "../types/types";
import { updateTodo } from "../api/api";
import toast from "react-hot-toast";

export const useUpdateTodo = () => {
  const queryClient = useQueryClient();
  const { mutate: udpate, isPending: isUpdating } = useMutation({
    mutationFn: ({ id, data }: { id: string; data: TodoType }) =>
      updateTodo(id, data),
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ["todos"] });
      toast.success("Todo Updated Successfully 🚀");
    },
    onError: () => {
      throw new Error("Error while updating data");
    },
  });

  return { udpate, isUpdating };
};
