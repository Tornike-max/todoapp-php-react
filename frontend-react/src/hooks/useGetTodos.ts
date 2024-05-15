import { useQuery } from "@tanstack/react-query";
import { getTodos } from "../api/api";

export const useGetTodos = () => {
  const { data, isPending, isError } = useQuery({
    queryKey: ["todos"],
    queryFn: () => getTodos(),
  });

  return { data, isPending, isError };
};
