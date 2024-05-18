import MenuItem from "./MenuItem";
import { useGetTodos } from "../hooks/useGetTodos";

const MainItems = () => {
  const { data, isPending } = useGetTodos();

  if (isPending) return <p>Loading...</p>;

  return (
    <ul className="w-full flex justify-center items-start flex-col mx-10 py-6 gap-4 rounded-2xl">
      {data
        ? data.map(
            (item: {
              todoId: number;
              model: string;
              year: number;
              car_engine: number;
              variant: string;
            }) => <MenuItem key={item.todoId} item={item} />
          )
        : "Unauthorized"}
    </ul>
  );
};

export default MainItems;
