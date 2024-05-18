import MainHeader from "../components/MainHeader";
import MainItems from "../components/MainItems";
import { useGetAuthUser } from "../hooks/useGetAuthUser";

const Main = () => {
  const { authUser, isUserPending } = useGetAuthUser();

  if (isUserPending) return null;
  console.log(authUser);
  return (
    <div className="max-w-[600px] w-full flex justify-center items-center flex-col gap-8 m-auto  my-4 ">
      <MainHeader />
      <MainItems />
    </div>
  );
};

export default Main;
