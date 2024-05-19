import { useQuery } from "@tanstack/react-query";
import { getAuthUser } from "../api/api";

export const useGetAuthUser = (users_id: string) => {
  const { data: authUser, isPending: isUserPending } = useQuery({
    queryKey: ["users"],
    queryFn: () => getAuthUser(users_id || ""),
  });

  return { authUser, isUserPending };
};
