import { Divider } from "@nextui-org/react";
import { todoItems } from "../constants/constants";
import MenuItem from "./MenuItem";

const MainItems = () => {
  return (
    <ul className="w-full flex justify-center items-start flex-col px-4 py-6 gap-4 rounded-2xl">
      {todoItems.map((item) => (
        <>
          <MenuItem key={item.brand} item={item} />
          <Divider />
        </>
      ))}
    </ul>
  );
};

export default MainItems;
