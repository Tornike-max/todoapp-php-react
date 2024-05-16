import { useQuery } from "@tanstack/react-query";
import { getSingleTodo } from "../api/api";

export const useGetTodo = (todoId: string) => {
  const { data: todoData, isPending: isTodoPending } = useQuery({
    queryKey: ["todos", todoId],
    queryFn: () => getSingleTodo(todoId),
  });

  return { todoData, isTodoPending };
};
