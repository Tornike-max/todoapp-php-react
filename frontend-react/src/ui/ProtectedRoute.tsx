import { useAuth } from "../context/useAuth";

const ProtectedRoute = ({ children }: { children: React.ReactNode }) => {
  const { authUser, isUserPending } = useAuth();

  if (isUserPending) return null;

  return authUser ? children : false;
};

export default ProtectedRoute;
