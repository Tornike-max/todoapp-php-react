import { Button } from "@nextui-org/button";
import { useDisclosure } from "@nextui-org/react";
import { useSearchParams } from "react-router-dom";
import EditModalComponent from "../ui/EditModalComponent";

const MenuItem = ({
  item,
}: {
  item: {
    todoId: number;
    model: string;
    year: number;
    car_engine: number;
    variant: string;
  };
}) => {
  const [searchParams, setSearchParams] = useSearchParams();
  const getId = searchParams.get("todoId") || "";
  const { isOpen, onOpenChange, onOpen, onClose } = useDisclosure();

  const handleEdit = (id: number) => {
    searchParams.set("todoId", String(id));
    setSearchParams(searchParams);
    onOpen();
  };
  return (
    <>
      <li className="w-full flex flex-col md:flex-row md:items-center border  p-4 rounded-lg bg-slate-200  mb-4">
        <div className="flex items-start md:items:center justify-start flex-col md:flex-row w-full gap-10">
          <div className="md:flex md:flex-col md:gap-2 px-2 space-x-2 md:space-x-0">
            <span className="text-xl font-bold">{item.model}</span>
            <span>Year: {item.year}</span>
          </div>
          <div className="md:flex md:flex-col md:gap-2 px-2 mt-2 md:mt-0 space-x-2 md:space-x-0">
            <span className="text-lg font-medium">{item.variant}</span>
            <span>Engine: {item.car_engine}</span>
          </div>
        </div>

        <div className="flex flex-col mt-4 md:mt-0 md:w-1/4 gap-2">
          <Button
            variant="shadow"
            color="primary"
            className="mb-2 md:mb-0 md:mr-4 w-full"
            onClick={() => handleEdit(item.todoId)}
          >
            Edit
          </Button>
          <Button variant="shadow" color="danger" className=" w-full">
            Delete
          </Button>
        </div>
      </li>
      {isOpen && (
        <EditModalComponent
          isOpen={isOpen}
          onOpenChange={onOpenChange}
          onClose={onClose}
          todoId={getId}
        />
      )}
    </>
  );
};

export default MenuItem;
