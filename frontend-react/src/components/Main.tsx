import MainHeader from "./MainHeader";
import MainItems from "./MainItems";

const Main = () => {
  return (
    <div className="max-w-[600px] w-full flex justify-center items-center flex-col gap-8 m-auto  my-4 ">
      <MainHeader />
      <MainItems />
    </div>
  );
};

export default Main;
