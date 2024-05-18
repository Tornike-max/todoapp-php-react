import { useQuery } from "@tanstack/react-query";
import { getAuthUser } from "../api/api";

export const useGetAuthUser = () => {
  const { data: authUser, isPending: isUserPending } = useQuery({
    queryKey: ["users"],
    queryFn: getAuthUser,
  });

  return { authUser, isUserPending };
};
