import { useMutation, useQueryClient } from "@tanstack/react-query";
import { addTodo } from "../api/api";
import { TodoType } from "../types/types";
import toast from "react-hot-toast";

export const useAddTodo = () => {
  const queryClient = useQueryClient();
  const { mutate, isPending } = useMutation({
    mutationFn: ({ data }: { data: TodoType }) => addTodo({ data }),
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ["todos"] });
      toast.success("Todo Added Successfully 🚀");
    },
    onError: () => {
      throw new Error("Error while add todo");
    },
  });

  return { mutate, isPending };
};
