import { Spinner } from "@nextui-org/react";
import MainHeader from "../components/MainHeader";
import MainItems from "../components/MainItems";
import { useAuth } from "../context/useAuth";
import { useGetAuthUser } from "../hooks/useGetAuthUser";

const Main = () => {
  const { authUser: data } = useAuth();
  const { authUser, isUserPending } = useGetAuthUser(data?.users_id || "");

  if (isUserPending) return <Spinner />;
  console.log(authUser);
  return (
    <div className="max-w-[600px] w-full flex justify-center items-center flex-col gap-8 m-auto  my-4 ">
      <MainHeader />
      <MainItems />
    </div>
  );
};

export default Main;
