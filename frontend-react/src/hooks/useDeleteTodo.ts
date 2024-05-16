import { useMutation, useQueryClient } from "@tanstack/react-query";
import { deleteTodoApi } from "../api/api";
import toast from "react-hot-toast";

export const useDeleteTodo = () => {
  const queryClient = useQueryClient();
  const { mutate: deleteTodo, isPending: isDeleting } = useMutation({
    mutationFn: (todoId: string) => deleteTodoApi(todoId),
    onSuccess: () => {
      toast.success("Todo Deleted Successfully ✅");
      queryClient.invalidateQueries({ queryKey: ["todos"] });
    },
    onError: () => {
      toast.error("Error while deleting!");
    },
  });

  return { deleteTodo, isDeleting };
};
