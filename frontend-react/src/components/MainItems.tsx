import MenuItem from "./MenuItem";
import { useGetTodos } from "../hooks/useGetTodos";

const MainItems = () => {
  const { data, isPending } = useGetTodos();

  if (isPending) return <p>Loading...</p>;

  return (
    <ul className="w-full flex justify-center items-start flex-col px-4 py-6 gap-4 rounded-2xl">
      {data.map(
        (item: {
          todoId: number;
          brand: string;
          year: number;
          car_engine: number;
          variant: string;
        }) => (
          <MenuItem key={item.todoId} item={item} />
        )
      )}
    </ul>
  );
};

export default MainItems;
